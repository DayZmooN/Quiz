<?php
require_once '../../model/config.php';

$id = $_GET['id'];

// Supprimer la question
$sql_delete_question = "DELETE FROM questions WHERE id =?";
$stmt_delete_question = $conn->prepare($sql_delete_question);
if ($stmt_delete_question) {
    $stmt_delete_question->bind_param("i", $id);
    if ($stmt_delete_question->execute()) {
        header('location: ../../view/questions/indexquestions.php');
    } else {
        echo "Erreur : " . $sql_delete_question . "<br>" . $stmt_delete_question->error;
    }
} else {
    echo "Erreur lors de la préparation de la requête : " . $conn->error;
}
