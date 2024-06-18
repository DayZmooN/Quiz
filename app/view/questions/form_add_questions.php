<?php
ob_start();
require_once '../../model/config.php';

// Récupérer les catégories existantes
$sql = "SELECT id, name FROM categories";
$result = $conn->query($sql);
$categories = $result->fetch_all(MYSQLI_ASSOC);
?>

<form action="../../model/questions/create.php" method="post">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="difficulty">Difficulty</label>
        <select class="form-control" id="difficulty" name="difficulty" required>
            <option value="easy">Easy</option>
            <option value="medium">Medium</option>
            <option value="hard">Hard</option>
        </select>
    </div>
    <div class="form-group">
        <label for="option1">Option 1:</label>
        <div class="input-group">
            <input type="text" class="form-control" id="option1" name="option[]" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <input type="radio" name="correctAnswer" value="1" required>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="option2">Option 2:</label>
        <div class="input-group">
            <input type="text" class="form-control" id="option2" name="option[]">
            <div class="input-group-append">
                <div class="input-group-text">
                    <input type="radio" name="correctAnswer" value="2">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="option3">Option 3:</label>
        <div class="input-group">
            <input type="text" class="form-control" id="option3" name="option[]">
            <div class="input-group-append">
                <div class="input-group-text">
                    <input type="radio" name="correctAnswer" value="3">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="option4">Option 4:</label>
        <div class="input-group">
            <input type="text" class="form-control" id="option4" name="option[]">
            <div class="input-group-append">
                <div class="input-group-text">
                    <input type="radio" name="correctAnswer" value="4">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select class="form-control" id="category_id" name="category_id" required>
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Add Question</button>
</form>

<?php
$title = "Add Question";
$content = ob_get_clean();
require '../../../layout.php';
?>