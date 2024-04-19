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

    public function addComponent($subject_id, $component, $percentage)
    {
        $sql = "INSERT INTO grade_component (subject_id, component_name, weight) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$subject_id, $component, $percentage]);
    }

    public function getGradeComponent($subject_id)
    {
        $sql = "SELECT * FROM grade_component WHERE subject_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $subject_id); // Assuming $subject_id is an integer
        $stmt->execute();

        $result = $stmt->get_result(); // Get the result set
        $data = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as associative array

        return $data;



    }
}