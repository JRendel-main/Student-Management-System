<?php

class Attendance
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getStudentAttendance($student_id, $academic_id)
    {
        $sql = "SELECT * FROM attendance WHERE student_id = ? AND academic_id = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param('ii', $student_id, $academic_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $attendance = [];

        while ($row = $result->fetch_assoc()) {
            $attendance[] = $row;
        }

        return $attendance;
    }

    public function checkMonth($student_id, $academic_id, $month)
    {
        $sql = "SELECT * FROM attendance WHERE student_id = ? AND academic_id = ? AND month = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param('iis', $student_id, $academic_id, $month);
        $stmt->execute();

        $result = $stmt->get_result();
        $attendance = $result->fetch_assoc();

        return $attendance;
    }

    public function addStudentAttendance($student_id, $academic_id, $month, $school_days, $present_days)
    {
        $sql = "INSERT INTO attendance (student_id, academic_id, month, school_days, present_days) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param('iisii', $student_id, $academic_id, $month, $school_days, $present_days);
        $stmt->execute();

        return $stmt->affected_rows;
    }
}