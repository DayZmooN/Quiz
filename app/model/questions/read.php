<?php
require_once '../../model/config.php';

$sql = "SELECT q.id, q.name, q.difficulty, c.name AS category_name
        FROM questions q
        JOIN categories c ON q.category_id = c.id
        ORDER BY q.id";
$result = $conn->query($sql);
$questions = $result->fetch_all(MYSQLI_ASSOC);
