<?php
class Grades
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getGrades($student_id)
    {
        $sql = "SELECT * FROM grades WHERE student_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$student_id]);
        return $stmt->fetchAll();
    }
}