<?php
include '../../controllers/autoloader.php';
$db = new Database();
$conn = $db->connect();

$schoolYear = new Academic($conn);
$section = $schoolYear->getAllSection();

echo json_encode($section);