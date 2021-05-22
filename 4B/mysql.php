<?php

define('HOST', 'localhost');
define('USERNAME', 'dbuser');
define('PASSWORD', 'dbuser');
define('DBNAME', 'dumbways');
define('DEBUG', false);

/**
 * Class Mysql
 *
 * Credit to Unknown
 * This is not created by me, I just grab it from github longtime ago.
 */
class Mysql
{
    public $con;
    public $mysqli_Key;
    public $mysqli_Value;
    public $sql;
    public $id;
    public $table;
    private $row_count;

    function __construct()
    {
        if (HOST == "" or USERNAME == "" or PASSWORD == "" or DBNAME == "") {
            die("Please Enter DATABASE details in mysqli_conf.php file");
        }
        $this->con = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
        if ($this->con->connect_errno > 0) {
            die('Unable to connect to database [' . $this->con->connect_error . ']');
        }
    }

    public function query($sql)
    {
        return mysqli_query($this->con, $sql);
    }

    public function delete($sql)
    {
        $result = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
        if (DEBUG == true and php_sapi_name() == "cli") {
            echo $sql . "\n";
        }
        return $result;
    }

    public function update($sql)
    {
        $result = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
        if (DEBUG == true and php_sapi_name() == "cli") {
            echo $sql . "\n";
        }
        return $result;
    }

    public function insert($Array_sql, $tbl)
    {
        $con = $this->con;
        $mysqli_Key = "";
        $mysqli_Value = "";
        foreach ($Array_sql as $key => $sql_value) {
            $mysqli_Value .= '\'' . mysqli_real_escape_string($con, $sql_value) . '\'';
            $mysqli_Value .= ",";

            $mysqli_Key .= '' . $key . '';
            $mysqli_Key .= ",";
        }

        $mysqli_Value = rtrim($mysqli_Value, ",");
        $mysqli_Key = rtrim($mysqli_Key, ",");

        $sql = 'INSERT INTO ' . $tbl . ' (' . $mysqli_Key . ') VALUES(' . $mysqli_Value . ')';
        if (DEBUG == true and php_sapi_name() == "cli") {
            echo $sql . "\n";
        }
        $result = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
    }

    public function findById($id, $table)
    {
        $sql = "SELECT * FROM $table WHERE id = $id";
        return mysqli_query($this->con, $sql);
    }

    public function close()
    {
        return $this->con->close();
    }

    public function con()
    {
        return $this->con;
    }
}