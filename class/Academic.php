<?php
class Academic
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllAcademicYear()
    {
        $query = "SELECT * FROM academic_year";
        $result = $this->conn->query($query);
        $data = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function getAllSection()
    {
        $query = "SELECT * FROM section";
        $result = $this->conn->query($query);
        $data = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function addSection($section_name, $grade_level, $advisor_id)
    {
        $query = "INSERT INTO section (section_name, year, advisor_id) VALUES ('$section_name', '$grade_level', '$advisor_id')";
        $result = $this->conn->query($query);

        if (!$result) {
            die("Error in SQL query: " . $this->conn->error);
        }

        return $result;
    }
}