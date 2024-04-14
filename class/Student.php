<?php

class Student
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addStudent($first_name, $middle_name, $last_name, $email, $dob, $barangay, $city, $province, $nationality, $religion, $gender, $remarks, $section_id)
    {
        $query = "INSERT INTO student (section_id, first_name, middle_name, last_name, email, dob, barangay, city, province, nationality, religion, gender, remarks) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = $this->conn->prepare($query);

        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("issssssssssss", $section_id, $first_name, $middle_name, $last_name, $email, $dob, $barangay, $city, $province, $nationality, $religion, $gender, $remarks);

            // Execute the statement
            if ($stmt->execute()) {
                // Insert successful
                return true;
            } else {
                // Error handling
                return false;
            }
        } else {
            // Error handling
            return false;
        }
    }

    public function getAllBoys($section_id)
    {
        $query = "SELECT * FROM student WHERE section_id = ? AND gender = 'Male'";
        $stmt = $this->conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $section_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = [];

            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            return $data;
        } else {
            return false;
        }
    }
}