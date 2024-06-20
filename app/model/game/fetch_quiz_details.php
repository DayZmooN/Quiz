<?php
require $_SERVER['DOCUMENT_ROOT'] . '/Quiz/app/model/config.php';
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $quiz_id = $_GET['id'];

    try {
        $sql = "SELECT q.id, q.name, qq.question_id,qs.name,qs.options
        FROM quizzes q
        JOIN quiz_questions qq ON q.id = qq.quiz_id
        JOIN questions qs ON qq.question_id =qs.id
        WHERE q.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $quiz_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($data);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(array("message" => "Erreur lors de la récupération du quiz : " . $e->getMessage()));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "ID du quiz non spécifié."));
}
