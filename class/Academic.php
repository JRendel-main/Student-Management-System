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
        $query = 'SELECT a.*, b.strand_name, CONCAT(c.first_name, " ", c.last_name) as advisor_name FROM section a, strand b, teacher c WHERE a.strand_id = b.strand_id AND a.advisor_id = c.teacher_id ORDER BY a.section_id DESC';
        $result = $this->conn->query($query);
        $data = [];

        if (!$result) {
            // Handle SQL error
            echo "Error: " . $this->conn->error;
            return $data;
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }


    public function addSection($section_name, $grade_level, $advisor_id, $strand_id)
    {
        $query = "INSERT INTO section (section_name, year, advisor_id, strand_id) VALUES ('$section_name', '$grade_level', '$advisor_id', '$strand_id')";
        $result = $this->conn->query($query);

        if (!$result) {
            die("Error in SQL query: " . $this->conn->error);
        }

        return $result;
    }

    public function getAllStrand()
    {
        $query = "SELECT * FROM strand";
        $result = $this->conn->query($query);
        $data = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function addStrand($strand_name)
    {
        $query = "INSERT INTO strand (strand_name) VALUES ('$strand_name')";
        $result = $this->conn->query($query);

        if (!$result) {
            die("Error in SQL query: " . $this->conn->error);
        }

        return $result;
    }

    public function getTeacherId($user_id)
    {
        $query = "SELECT teacher_id FROM teacher WHERE user_id = $user_id";
        $results = $this->conn->query($query);

        // get the teacher id
        $teacher = $results->fetch_assoc();
        return $teacher['teacher_id'];
    }

    public function getSection($advisor_id)
    {
        $query = "SELECT * FROM section WHERE advisor_id = $advisor_id";
        $results = $this->conn->query($query);

        // get the section name
        $section = $results->fetch_assoc();
        return $section;

    }


    public function getTotalStudents($teacher_id)
    {
        $query = "SELECT COUNT(*) as total_students FROM student WHERE section_id = (SELECT section_id FROM section WHERE advisor_id = $teacher_id)";
        $results = $this->conn->query($query);

        // get the total students
        $students = $results->fetch_assoc();
        return $students['total_students'];
    }

    public function getAllSemester()
    {
        $query = "SELECT * FROM semester";
        $result = $this->conn->query($query);
        $data = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function getStrand($strand_id)
    {
        $query = "SELECT * FROM strand WHERE strand_id = $strand_id";
        $result = $this->conn->query($query);
        $data = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }
}