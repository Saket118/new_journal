<?php

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "yemen_demo";

    public $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect(
            $this->host,
            $this->user,
            $this->password,
            $this->database
        );

        if (!$this->conn) {
            die("Database Connection Failed: " . mysqli_connect_error());
        }

        mysqli_set_charset($this->conn, "utf8");
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

