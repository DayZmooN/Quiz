<?php
require_once '../../model/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $difficulty = $_POST['difficulty'];
    $options = $_POST['option'];
    $correctAnswer = $_POST['correctAnswer'];
    $category_id = $_POST['category_id'];

    // Mise à jour de la question
    $sql = "UPDATE questions SET name = ?, difficulty = ?, options = ?, correctAnswer = ?, category_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiii", $name, $difficulty, json_encode($options), $correctAnswer, $category_id, $id);

    if ($stmt->execute()) {
        header("Location: ../../view/questions/indexquestions.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
