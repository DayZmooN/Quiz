<?php
require_once '../../model/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $difficulty = $_POST['difficulty'];
    $options = $_POST['option'];
    $correctAnswer = $_POST['correctAnswer'];
    $category_id = $_POST['category_id'];

    // Insertion de la question
    $sql = "INSERT INTO questions (name, difficulty, options, correctAnswer, category_id) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $name, $difficulty, json_encode($options), $correctAnswer, $category_id);

    if ($stmt->execute()) {
        header("Location: ../../view/questions/indexquestions.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
