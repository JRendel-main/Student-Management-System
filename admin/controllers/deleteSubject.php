<?php

include '../../controllers/autoloader.php';

$db = new Database();
$conn = $db->connect();

$subjectId = $_POST['subjectId'];

$subject = new Subject($conn);
$result = $subject->deleteSubject($subjectId);

if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Subject deleted successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to delete subject']);
}