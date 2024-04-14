<?php

include '../../controllers/autoloader.php';

$db = new Database();
$conn = $db->connect();

$teacher_id = $_POST['teacher_id'];

$academic = new Academic($conn);
$section = $academic->getSection($teacher_id);

$section_id = $section['section_id'];
$boys = new Student($conn);
$boysList = $boys->getAllBoys($section_id);

echo json_encode($boysList);