<?php

include '../../controllers/autoloader.php';

$component = $_POST['component'];
$percentage = $_POST['percentage'];
$subjectId = $_POST['subject_id'];
// echo the array 
json_encode(array('component' => $component, 'percentage' => $percentage));

$db = new Database();
$conn = $db->connect();

$grades = new Grades($conn);

// add every component and percentage to the database
foreach ($component as $key => $value) {
    $grades->addComponent($subjectId, $component[$key], $percentage[$key]);
}

echo json_encode(array('success' => true, 'message' => 'Component added successfully'));
?>