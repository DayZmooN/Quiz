<?php
require $_SERVER['DOCUMENT_ROOT'] . '/Quiz/app/model/config.php';

$sql = "SELECT id, name, description FROM quizzes
wher";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
