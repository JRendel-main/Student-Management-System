<?php
class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function login($username, $password)
    {
        // Prepare SQL statement
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password === $row['password_hash']) {
                return [
                    'success' => true,
                    'user' => $row
                ];
            } else {
                return [
                    'success' => false,
                    'error' => 'Invalid username or password'
                ];
            }
        } else {
            return [
                'success' => false,
                'error' => 'Invalid username or password'
            ];
        }
    }

    public function getAdminInfo($username)
    {
        $sql = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }
}