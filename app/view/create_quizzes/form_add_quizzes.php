<?php
ob_start();
require '../../model/quizzes/create.php';
?>

<div class="container mt-5">
    <h2 class="mb-4">Créer un quiz</h2>
    <form action="../../model/quizzes/create.php" method="post" class="bg-light p-4 shadow-sm rounded">
        <div class="form-group">
            <label for="name">Nom du quiz</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Entrez le nom du quiz" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Entrez la description du quiz" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>

<?php
$title = "Créer un quiz";
$content = ob_get_clean();
require '../../../layout.php';
?>