<?php
ob_start();
require '../../model/config.php';
require '../../model/quizzes/read.php';
?>

<?php while ($quiz = $result->fetch_assoc()) : ?>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($quiz['name']) ?></h6>
            <p class="card-text"><?= htmlspecialchars($quiz['description']) ?></p>
            <a href="./app/view/quizzes/form_edit_quizzes.php?id=<?= $quiz['id'] ?>" class="card-link">edit</a>
            <a href="#" class="card-link">delete</a>
        </div>
    </div>
<?php endwhile; ?>

<?php
$title = 'Home';
$content = ob_get_clean();
require '../../../layout.php';
