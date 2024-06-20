<?php
ob_start();
require $_SERVER['DOCUMENT_ROOT'] . '/Quiz/app/model/config.php';
$id = $_GET['id'];
// Requête pour récupérer tous les IDs depuis une table (par exemple 'quizzes')
$sql = "SELECT id FROM quizzes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();


?>

<div id="quiz-container">
    <ul>

        <input class="quiz-id" type="hidden" data-id="<?= $row['id'] ?>">


    </ul>
</div>

<?php
$title = 'game';
$content = ob_get_clean();
require '../../../layout.php';
?>