<?php

trait Model
{
    // multiple inheritance using trait
    use Database;

    protected $limit = 10;
    protected $offset = 0;
    protected $order_type     = "desc";
    protected $order_column = "company";
    public $errors         = [];

    public function findAll()
    {

        $query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";

        return $this->query($query);
    }


    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " AND ";
        }

        // not equal filtering : optional 
        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " AND ";
        }

        $query = rtrim($query, "  AND ");
        $query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";

        $data = array_merge($data, $data_not);

        return $this->query($query, $data);
    }

    public function first($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " AND ";
        }

        // not equal filtering : optional 
        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " AND ";
        }

        $query = rtrim($query, "  AND ");
        $query .= " limit $this->limit offset $this->offset";

        $data = array_merge($data, $data_not);
        $result = $this->query($query, $data);
        if ($result) {
            return $result[0];
        }
        return false;
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
        $this->query($query, $data);

        return false;
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

        // show($query);
        $this->query($query, $data);
        return false;
    }

    public function delete($id, $id_column = 'id')
    {
        $data[$id_column] = $id;
        $query = "delete from $this->table where $id_column = :$id_column";
        $this->query($query, $data);

        return false;
    }
}
