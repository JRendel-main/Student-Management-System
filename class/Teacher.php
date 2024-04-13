<?php

class Teacher
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function fetchTeachers($requestData)
    {
        $columns = array(
            0 => 'teacher.teacher_id',
            1 => 'CONCAT(teacher.first_name, " ", teacher.middle_name, " ", teacher.last_name) AS name',
            2 => 'user.email',
            3 => 'teacher.gender',
            4 => 'teacher.contact_num'
        );

        $sql = "SELECT teacher.teacher_id, 
                       CONCAT(teacher.first_name, ' ', teacher.middle_name, ' ', teacher.last_name) AS name, 
                       user.email, 
                       teacher.gender, 
                       teacher.contact_num 
                FROM teacher 
                INNER JOIN user ON teacher.user_id = user.user_id";

        if (!empty($requestData['order'])) {
            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];
        }

        $query = $this->conn->query($sql);

        if (!$query) {
            // Error occurred in SQL query execution
            die("SQL Error: " . $this->conn->error);
        }

        $totalData = $query->num_rows;
        $totalFiltered = $totalData;

        $sql .= " LIMIT " . $requestData['start'] . ", " . $requestData['length'];
        $query = $this->conn->query($sql);

        if (!$query) {
            // Error occurred in SQL query execution
            die("SQL Error: " . $this->conn->error);
        }

        $data = array();
        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }

        return array(
            "totalRecords" => $totalData,
            "totalFiltered" => $totalFiltered,
            "data" => $data
        );
    }

    public function deleteTeacher($id)
    {
        $sql = "DELETE FROM teacher WHERE teacher_id = $id";
        $query = $this->conn->query($sql);

        if (!$query) {
            // Error occurred in SQL query execution
            die("SQL Error: " . $this->conn->error);
        }

        return true;
    }
}

?>