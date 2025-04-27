<?php

trait Model
{
    // multiple inheritance using trait
    use Database;

    protected $limit = 10;
    protected $offset = 0;
    protected $order_type     = "desc";
    //protected $order_column = "id";
    public $errors         = [];

    // ------------usage example-------------------

    // $user = new User;
    // $arr['email'] = "name@example.com";

    // $result = $model->where(data_for_filtering, data_not_for_filtering);
    // $result = $model->insert(insert_data);
    // $result = $model->update(filtering_data updating_data, id_column_for_filtering);
    // $result = $model->delete(id, id_column);
    // $result = $user->findAll();

    // show($result);

    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
    }


    public function findAll()
    {

        $query = "select * from $this->table limit $this->limit offset $this->offset";

        return $this->query($query);
    }

    public function count($column = '*', $conditions = [])
    {
        $query = "SELECT COUNT($column) as count FROM $this->table";

        if (!empty($conditions)) {
            $query .= " WHERE ";
            $conditionKeys = array_keys($conditions);
            foreach ($conditionKeys as $key) {
                $query .= "$key = :$key AND ";
            }
            $query = rtrim($query, " AND ");
        }

        $result = $this->query($query, $conditions);
        return $result[0]->count ?? 0;
    }

    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        $query = "select * from $this->table ";

        if (!(empty($data) && empty($data_not))) {
            $query .= "where ";

            foreach ($keys as $key) {
                $query .= $key . " = :" . $key . " AND ";
            }

            // not equal filtering : optional 
            foreach ($keys_not as $key) {
                $query .= $key . " != :" . $key . " AND ";
            }
        }

        //echo "Query before trimming: " . $query . PHP_EOL;

        $query = rtrim($query);
        if (substr($query, -3) === "AND") {
            $query = substr($query, 0, -4); // Remove the last " AND"
        }
        if ($this->order_column && $this->order_type) {
            $query .= " order by $this->order_column $this->order_type";
        }

        // Add limit and offset only if they are set
        if ($this->limit > 0) {
            $query .= " limit $this->limit";
        }
        if ($this->offset > 0) {
            $query .= " offset $this->offset";
        }

        //show($query);
        $data = array_merge($data, $data_not);

        //for query debugging
        // echo "Generated Query From model: " . $query . PHP_EOL;
        // echo "Data Parameters: ";
        // print_r($data);

        return $this->query($query, $data);
    }

    public function first($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        $query = "SELECT * FROM $this->table ";

        if (!(empty($data) && empty($data_not))) {
            $query .= "WHERE ";

            foreach ($keys as $key) {
                //echo "Key: " . $key . PHP_EOL;
                $query .= $key . " = :" . $key . " AND ";
            }

            // not equal filtering : optional 
            foreach ($keys_not as $key) {
                $query .= $key . " != :" . $key . " AND ";
            }

            // foreach ($keys as $key) {
            //     echo "Key: $key, Placeholder: :" . $key . PHP_EOL;
            // }
        }

        //echo "Query before trimming: " . $query . PHP_EOL;

        $query = rtrim($query);
        if (substr($query, -3) === "AND") {
            $query = substr($query, 0, -4); // Remove the last " AND"
        }
        $query .= " LIMIT $this->limit OFFSET $this->offset";

        // $query = "SELECT * FROM driver WHERE DriverID = :DriverID LIMIT 10 OFFSET 0";

        // echo "Generated Query From model: " . $query . PHP_EOL;
        // echo "Data Parameters: ";
        // print_r($data);

        //show($query);
        $data = array_merge($data, $data_not);
        $result = $this->query($query, $data);
        if ($result) {
            //var_dump($result[0]);
            return $result[0];
        }
        return false;
    }

    // method for vertical and horizontal filtering
    // use like this :
    // $where = [
    //     'status' => 'active',
    //     'price' => ['operator' => '<', 'value' => 100],
    //     'id' => ['in' => [1, 2, 3]]
    // ];
    // $model->selectWhere(['id', 'name'], $where, []);

    public function selectWhere(
        $columns = ['*'],
        $conditions = [],
        $additionalData = [],
        $orderBy = null,
        $groupBy = null
    ) {
        // Convert columns to string
        $columns_str = implode(", ", $columns);

        // Start query
        $query = "SELECT $columns_str FROM $this->table ";

        $data = [];

        // Add conditions
        if (!empty($conditions)) {
            $query .= "WHERE ";

            foreach ($conditions as $key => $value) {
                if ($key === 'raw') {
                    // Handle raw SQL conditions
                    $query .= "$value AND ";
                } elseif (is_array($value)) {
                    if (isset($value['operator']) && isset($value['value'])) {
                        $query .= "$key {$value['operator']} :$key AND ";
                        $data[$key] = $value['value'];
                    } elseif (isset($value['in'])) {
                        // Handle IN operation
                        $placeholders = implode(", ", array_map(fn($i) => ":{$key}_$i", array_keys($value['in'])));
                        $query .= "$key IN ($placeholders) AND ";
                        foreach ($value['in'] as $i => $inValue) {
                            $data["{$key}_$i"] = $inValue;
                        }
                    } elseif (isset($value['not in'])) {
                        // Handle NOT IN operation
                        $placeholders = implode(", ", array_map(fn($i) => ":{$key}_$i", array_keys($value['not in'])));
                        $query .= "$key NOT IN ($placeholders) AND ";
                        foreach ($value['not in'] as $i => $inValue) {
                            $data["{$key}_$i"] = $inValue;
                        }
                    }
                } else {
                    $query .= "$key = :$key AND ";
                    $data[$key] = $value;
                }
            }

            // Trim trailing AND
            $query = rtrim($query, " AND ");
        }

        // Add GROUP BY
        if ($groupBy) {
            $query .= " GROUP BY $groupBy";
        }

        // Add ORDER BY
        if ($orderBy) {
            $query .= " ORDER BY $orderBy";
        }

        // Add LIMIT and OFFSET
        if ($this->limit) {
            $query .= " LIMIT $this->limit";
            if ($this->offset) {
                $query .= " OFFSET $this->offset";
            }
        }

        // show($query);
        // Merge with additional data
        $data = array_merge($data, $additionalData);

        // Execute the query
        return $this->query($query, $data);
    }


    public function insert($data)
    {
        /** remove unwanted data **/
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {

                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "insert into $this->table (" . implode(",", $keys) . ") values (:" . implode(" ,:", $keys) . ")";
        $result = $this->query($query, $data);

        // show($result);
        if ($result) {
            // Get the last inserted ID
            return $this->lastInsertId();
        }

        return false;
    }

    public function insertBatch($data)
    {
        foreach ($data as $row) {
            $result = $this->insert($row);
            // show($result);
            if ($result === false) {
                return false;
            }
        }
        return true;
    }

    public function update($id, $data, $id_column = 'id')
    {
        // check if allowed columns are only updated and remove unwanted data
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "update $this->table set ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . ", ";
        }

        $query = rtrim($query, ", ");
        $query .= " where $id_column = :$id_column";

        $data[$id_column] = $id;

        //show($query);
        $this->query($query, $data);
        return false;
    }

    public function updateWithConditions($data, $conditions)
    {
        // Check if allowed columns are only updated and remove unwanted data
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "UPDATE $this->table SET ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . ", ";
        }

        $query = rtrim($query, ", ");
        $query .= " WHERE ";

        $conditionKeys = array_keys($conditions);
        foreach ($conditionKeys as $key) {
            $query .= $key . " = :" . $key . " AND ";
        }

        $query = rtrim($query, " AND ");

        // Merge data and conditions for binding
        $params = array_merge($data, $conditions);

        // Execute the query
        $this->query($query, $params);
        return true;
    }

    public function delete($id, $id_column = 'id')
    {
        $data[$id_column] = $id;
        $query = "delete from $this->table where $id_column = :$id_column";
        $this->query($query, $data);

        return false;
    }

    public function deleteWithConditions($conditions)
    {
        $query = "DELETE FROM $this->table WHERE ";

        $conditionKeys = array_keys($conditions);
        foreach ($conditionKeys as $key) {
            $query .= $key . " = :" . $key . " AND ";
        }

        $query = rtrim($query, " AND ");

        // Execute the query
        $this->query($query, $conditions);
        return true;
    }

    public function join($table, $joinCondition, $data = [], $data_not = [], $columns = '*', $order_column = 'id', $order_type = 'ASC', $limit = 10, $offset = 0)
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        //print_r($columns);

        if (is_array($columns)) {
            $columns = array_map(function ($col) {
                return trim($col); // Avoid any weird whitespace issues
            }, $columns);
            $columns = implode(', ', $columns);
        } elseif (empty($columns)) {
            $columns = '*';
        }

        $query = "SELECT $columns FROM $this->table JOIN $table ON $joinCondition WHERE ";

        $mappedParams = []; // Holds the parameter mapping
        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " AND ";
            $mappedParams[$key] = $data[$key]; // Map directly to the key
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " AND ";
            $mappedParams[$key] = $data_not[$key]; // Map directly to the key
        }

        //echo "Query before trimming: " . $query . PHP_EOL;

        $query = rtrim($query);
        if (substr($query, -3) === "AND") {
            $query = substr($query, 0, -4); // Remove the last " AND"
        }
        if ($this->order_column && $this->order_type) {
            $query .= " order by $this->order_column $this->order_type";
        }
        if ($this->limit > 0) {
            $query .= " limit $this->limit";
        }
        if ($this->offset > 0) {
            $query .= " offset $this->offset";
        }

        // echo "Generated Query From model: " . $query . PHP_EOL;
        // echo "Data Parameters: ";
        // print_r($mappedParams);

        $data = array_merge($data, $data_not);

        return $this->query($query, $data);
    }
}
