<?php
ob_start();
require '../../model/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les données du quiz
    $sql_quiz = "SELECT * FROM quizzes WHERE id = ?";
    $stmt_quiz = $conn->prepare($sql_quiz);
    $stmt_quiz->bind_param("i", $id);
    $stmt_quiz->execute();
    $result_quiz = $stmt_quiz->get_result();
    $quiz = $result_quiz->fetch_assoc();

    // Récupérer les questions associées au quiz
    $sql_selected_questions = "SELECT question_id FROM quiz_questions WHERE quiz_id = ?";
    $stmt_selected_questions = $conn->prepare($sql_selected_questions);
    $stmt_selected_questions->bind_param("i", $id);
    $stmt_selected_questions->execute();
    $result_selected_questions = $stmt_selected_questions->get_result();
    $selectedQuestions = [];
    while ($row = $result_selected_questions->fetch_assoc()) {
        $selectedQuestions[] = $row['question_id'];
    }

    // Récupérer toutes les questions disponibles
    $sql_all_questions = "SELECT * FROM questions";
    $result_all_questions = $conn->query($sql_all_questions);
} else {
    echo "ID du quiz non spécifié.";
    exit;
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Éditer un quiz</h2>
    <form action="../../model/quizzes/update.php" method="post" class="bg-light p-4 shadow-sm rounded">
        <input type="hidden" name="id" value="<?= isset($quiz['id']) ? htmlspecialchars($quiz['id']) : '' ?>">

        <div class="form-group">
            <label for="name">Nom du quiz</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Entrez le nom du quiz" value="<?= isset($quiz['name']) ? htmlspecialchars($quiz['name']) : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Entrez la description du quiz" required><?= isset($quiz['description']) ? htmlspecialchars($quiz['description']) : '' ?></textarea>
        </div>

        <!-- Affichage des questions associées au quiz avec des cases à cocher -->
        <div class="form-group mt-4">
            <label for="questions">Questions :</label>
            <?php while ($question = $result_all_questions->fetch_assoc()) : ?>
                <div class="flex items-center mb-4">
                    <input type="checkbox" id="question_<?= $question['id'] ?>" name="questions[]" value="<?= $question['id'] ?>" <?= in_array($question['id'], $selectedQuestions) ? 'checked' : '' ?>>
                    <label for="question_<?= $question['id'] ?>" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"><?= htmlspecialchars($question['name']) ?></label>
                </div>
            <?php endwhile; ?>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>

<?php
$title = "Éditer un quiz";
$content = ob_get_clean();
require '../../../layout.php';
?>