<?php

trait Database
{
    private $pdoInstance;

    private function connect()
    {
        if ($this->pdoInstance === null) {
            $string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
            try {
                $this->pdoInstance = new PDO($string, DBUSER, DBPASS);
                $this->pdoInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return $this->pdoInstance;
    }

    public function query($query, $data = [])
    {
        $con = $this->connect();
        $stmt = $con->prepare($query);
        // show($query);
        $check = $stmt->execute($data);
        // show($query);
        if ($check) {
            // If the query is a SELECT or similar, fetch results
            if (str_starts_with(strtoupper(trim($query)), 'SELECT')) {
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                return $result; // Return the fetched result set
            }

            // For INSERT, UPDATE, DELETE, or other queries, just return true
            return true;
        }

        $con = $this->connect();

        try {
            $stmt = $con->prepare($query);
            $stmt->execute($data);

            // Check query type and handle accordingly
            if (str_starts_with(strtoupper(trim($query)), 'SELECT')) {
                return $stmt->fetchAll(PDO::FETCH_OBJ); // Return objects
            }

            return true; // Return true for INSERT, UPDATE, DELETE
        } catch (PDOException $e) {
            // Set HTTP response code and log error
            http_response_code(500);

            // if ($debug) {
            //     echo "SQL Error: " . $e->getMessage() . PHP_EOL;
            // } else {
            //     echo "An internal server error occurred. Please try again later.";
            // }

            error_log("SQL Error: " . $e->getMessage());
            return false;
        }
    }


    public function get_row($query, $data = [])
    {
        $con = $this->connect();
        $stmt = $con->prepare($query);
        $check = $stmt->execute($data);
        if ($check) {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            if (is_array($result) && count($result)) {
                return $result[0];
            }
        }

        return false;
    }

    public function lastInsertId()
    {
        $con = $this->connect();
        return $con->lastInsertId();
    }
}
