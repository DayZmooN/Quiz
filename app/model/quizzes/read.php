<?php
require $_SERVER['DOCUMENT_ROOT'] . '/Quiz/app/model/config.php';

$sql = "SELECT id, name, description FROM quizzes";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
// $data = $result->fetch_all(MYSQLI_ASSOC);
// echo json_encode($data);
