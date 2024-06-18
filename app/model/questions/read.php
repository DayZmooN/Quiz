<?php
require_once '../../model/config.php';

// Récupérer les filtres
$category_filter = isset($_GET['category']) ? $_GET['category'] : '';
$difficulty_filter = isset($_GET['difficulty']) ? $_GET['difficulty'] : '';

$sql = "SELECT q.id, q.name, q.difficulty, c.name AS category_name
        FROM questions q
        JOIN categories c ON q.category_id = c.id
        WHERE 1=1";

if (!empty($category_filter)) {
        $sql .= " AND q.category_id = ?";
}
if (!empty($difficulty_filter)) {
        $sql .= " AND q.difficulty = ?";
}

$sql .= " ORDER BY q.id";

$stmt = $conn->prepare($sql);

if (!empty($category_filter) && !empty($difficulty_filter)) {
        $stmt->bind_param("is", $category_filter, $difficulty_filter);
} elseif (!empty($category_filter)) {
        $stmt->bind_param("i", $category_filter);
} elseif (!empty($difficulty_filter)) {
        $stmt->bind_param("s", $difficulty_filter);
}

$stmt->execute();
$result = $stmt->get_result();
$questions = $result->fetch_all(MYSQLI_ASSOC);
