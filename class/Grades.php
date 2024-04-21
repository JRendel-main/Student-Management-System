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

    public function deleteComponent($component)
    {
        $sql = "DELETE FROM grade_component WHERE component_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $component); // Assuming $component is an integer
        $stmt->execute();

        // check if the delete was successful
        return $stmt->affected_rows;
    }

    public function getGradesForStudentAndSubject($student_id, $subject_id)
    {
        $sql = "SELECT * FROM grades WHERE student_id = ? AND subject_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$student_id, $subject_id]);
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function calculateTotalGrade($grades, $gradeComponent)
    {
        $totalGrade = 0;
        foreach ($gradeComponent as $component) {
            $totalGrade += $grades[$component['component_id']] * $component['weight'];
        }
        return $totalGrade;
    }
}