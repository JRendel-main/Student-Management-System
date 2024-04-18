<?php 

class Section {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getSection($section_id) {
        $sql = "SELECT * FROM section WHERE section_id = $section_id";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }

    public function getAdvisorySection($teacher_id) {
        $sql = "SELECT * FROM section where advisor_id = $teacher_id";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }
}