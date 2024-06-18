<?php
require '../../model/config.php';


$sql = "SELECT id, name FROM `questions`;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $questions = $_POST['questions'] ?? [];


    $conn->begin_transaction();


    try {
        // Préparer la requête SQL pour insérer le quiz
        $sql = "INSERT INTO `quizzes`(`name`, `description`) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $name, $description);
        $stmt->execute();


        // Récupérer l'identifiant du dernier quiz inséré
        $quizId = $conn->insert_id;


        // Préparer la requête SQL pour lier les questions au quiz
        $sql_question = "INSERT INTO quiz_questions (question_id, quiz_id) VALUES (?, ?)";
        $stmt_question = $conn->prepare($sql_question);


        foreach ($questions as $question) {
            $stmt_question->bind_param("ii", $question, $quizId);
            $stmt_question->execute();
        }


        $conn->commit();


        // Rediriger l'utilisateur vers la page du quiz créé
        header("Location: ../../view/quizzes/index_quizzes.php");
        exit;
    } catch (PDOException $e) {
        $conn->rollback();
        echo "Erreur : " . $e->getMessage();
    }
}
