<?php

class Database
{
    // private $host = 'sql6.freemysqlhosting.net';
    // private $user = 'sql6694128';
    // private $db = 'sql6694128';
    // private $pass = 'l5PAKhSSUA';

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db = 'student_management';

    public function connect()
    {
        $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($conn->connect_error) {
            die ("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}