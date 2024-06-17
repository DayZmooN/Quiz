<?php
require '../../model/config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["name"]) && isset($_POST["description"])) {
        $name = $_POST["name"];
        $description = $_POST["description"];
        // Préparer la requête SQL
        $sql = "INSERT INTO `quizzes`(`name`, `description`) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $name, $description);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Nouveau quiz créé avec succès";
        } else {
            echo "Execute failed: " . $stmt->error;
        }
        // Fermer la requête
        $stmt->close();
    } else {
        echo "Name or Description not set in POST data.";
    }
}

// Fermer la connexion
$conn->close();
