<?php

include '../../controllers/autoloader.php';

$db = new Database();
$conn = $db->connect();

$section_name = $_POST['sectionName'];
$grade_level = $_POST['gradeLevel'];
$advisor_id = $_POST['advisorId'];

$section = new Academic($conn);
$section->addSection($section_name, $grade_level, $advisor_id);

echo json_encode(['message' => 'Section added successfully!', 'success' => true]);