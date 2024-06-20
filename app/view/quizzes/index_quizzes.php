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
            <a href="/quiz/app/view/quizzes/form_edit_quizzes.php?id=<?= $quiz['id'] ?>" class="card-link">edit</a>
            <form action="../../model/quizzes/delete.php" method="post">
                <input type="hidden" name="id" value="<?= htmlspecialchars($quiz['id']) ?>">
                <button type="submit" class="card-link">Delete</button>
            </form>
            <a href="/quiz/app/view/game/game.php?id=<?= $quiz['id'] ?>" class="btn btn-primary">Commencer le quiz</a>
        </div>
    </div>
    </div>
<?php endwhile; ?>

<?php
$title = 'Home';
$content = ob_get_clean();
require '../../../layout.php';
