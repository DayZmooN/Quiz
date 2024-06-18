<?php
require '../../model/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $questions = $_POST['questions'] ?? [];

    $conn->begin_transaction();
    try {
        // Mettre à jour les informations du quiz
        $sql_update_quiz = 'UPDATE quizzes SET name = ?, description = ? WHERE id = ?';
        $stmt_update_quiz = $conn->prepare($sql_update_quiz);
        $stmt_update_quiz->bind_param("ssi", $name, $description, $id);
        $stmt_update_quiz->execute();

        // Supprimer les questions actuelles du quiz
        $sql_delete_questions = "DELETE FROM quiz_questions WHERE quiz_id = ?";
        $stmt_delete_questions = $conn->prepare($sql_delete_questions);
        $stmt_delete_questions->bind_param("i", $id);
        $stmt_delete_questions->execute();

        // Ajouter les nouvelles questions au quiz
        $sql_insert_questions = "INSERT INTO quiz_questions (quiz_id, question_id) VALUES (?, ?)";
        $stmt_insert_questions = $conn->prepare($sql_insert_questions);
        foreach ($questions as $question_id) {
            $stmt_insert_questions->bind_param("ii", $id, $question_id);
            $stmt_insert_questions->execute();
        }

        $conn->commit();
        echo "Mise à jour avec succès";
        header("Location: ../../../index.php");
        exit;
    } catch (Exception $e) {
        $conn->rollback();
        echo "Erreur lors de la mise à jour du quiz : " . $e->getMessage();
    }
}
