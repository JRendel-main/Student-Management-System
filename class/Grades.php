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

    public function addGrade($semester_id, $component_id, $highest_grade, $initial_grade, $student_id, $subject_id)
    {
        $sql = "INSERT INTO grades (semester_id, component_id, highest_grade, initial_grade, student_id, subject_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$semester_id, $component_id, $highest_grade, $initial_grade, $student_id, $subject_id]);
    }

    public function getGradesForStudentAndSubjectByComponent($student_id, $subject_id, $component_id)
    {
        $sql = "SELECT * FROM grades WHERE student_id = ? AND subject_id = ? AND component_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $student_id, $subject_id, $component_id); // Assuming all IDs are integers
        $stmt->execute();

        $result = $stmt->get_result(); // Get the result set
        $data = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as associative array

        return $data;
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

    public function getGradesForStudentAndSubject($student_id, $subject_id, $semester_id)
    {
        $sql = "SELECT a.grades_id, a.initial_grade, a.highest_grade, b.component_name, b.component_id, b.weight FROM grades a JOIN grade_component b ON a.component_id = b.component_id WHERE a.student_id = ? AND b.subject_id = ? AND a.semester_id = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("iii", $student_id, $subject_id, $semester_id); // Assuming $student_id and $subject_id are integers
        $stmt->execute();

        $result = $stmt->get_result(); // Get the result set

        $data = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as associative array

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

    public function updateInitialGrade($grade_id, $initial_grade)
    {
        $sql = "UPDATE grades SET initial_grade = ? WHERE grades_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $initial_grade, $grade_id); // Assuming $initial_grade and $grade_id are integers
        $stmt->execute();

        // check if the update was successful
        return $stmt->affected_rows;
    }

    public function updateHighestGrade($grade_id, $highest_grade)
    {
        $sql = "UPDATE grades SET highest_grade = ? WHERE grades_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $highest_grade, $grade_id); // Assuming $highest_grade and $grade_id are integers
        $stmt->execute();

        // check if the update was successful
        return $stmt->affected_rows;
    }

    public function deleteGrade($grade_id)
    {
        $sql = "DELETE FROM grades WHERE grades_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $grade_id); // Assuming $grade_id is an integer
        $stmt->execute();

        // check if the delete was successful
        return $stmt->affected_rows;
    }
}