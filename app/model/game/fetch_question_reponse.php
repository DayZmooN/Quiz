<?php
//response
require $_SERVER['DOCUMENT_ROOT'] . '/Quiz/app/model/config.php';

header('Content-Type: application/json');

try {
    $sql = "SELECT id, correctAnswer FROM questions WHERE id= ?";
    $id = intval($_GET['id']);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(array('error' => $e->getMessage()));
}
