<?php
require '../../model/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    if (isset($id)) {
        $conn->begin_transaction();
        try {
            // Requête pour supprimer les questions liées au quiz
            $sql_delete_questions = "DELETE FROM quiz_questions WHERE quiz_id = ?";
            $stmt_delete_questions = $conn->prepare($sql_delete_questions);
            $stmt_delete_questions->bind_param("i", $id);
            $stmt_delete_questions->execute();

            // Requête pour supprimer le quiz
            $sql_delete_quiz = "DELETE FROM quizzes WHERE id = ?";
            $stmt_delete_quiz = $conn->prepare($sql_delete_quiz);
            $stmt_delete_quiz->bind_param("i", $id);
            $stmt_delete_quiz->execute();

            $conn->commit();
            echo "Quiz supprimé avec succès";
            header("Location: /quiz/app/view/quizzes/index_quizzes.php");
            exit;
        } catch (Exception $e) {
            $conn->rollback();
            echo 'Erreur lors de la suppression du quiz : ' . $e->getMessage();
        }
    } else {
        echo 'ID du quiz non spécifié.';
    }
} else {
    echo 'Méthode de requête non supportée.';
}
