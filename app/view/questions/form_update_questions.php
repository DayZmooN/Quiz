<?php
ob_start();
require_once '../../model/config.php';

$id = $_GET['id'];

// Récupérer les informations de la question selectionné
$sql = "SELECT * FROM questions WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$question = $result->fetch_assoc();

// Récupérer les catégories existantes
$sql = "SELECT id, name FROM categories";
$result = $conn->query($sql);
$categories = $result->fetch_all(MYSQLI_ASSOC);

// Décoder les options JSON
$options = json_decode($question['options'], true);
?>

<form action="../../model/questions/update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $question['id']; ?>">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $question['name']; ?>" required>
    </div>
    <div class="form-group">
        <label for="difficulty">Difficulty</label>
        <select class="form-control" id="difficulty" name="difficulty" required>
            <option value="easy" <?php echo $question['difficulty'] == 'easy' ? 'selected' : ''; ?>>Easy</option>
            <option value="medium" <?php echo $question['difficulty'] == 'medium' ? 'selected' : ''; ?>>Medium</option>
            <option value="hard" <?php echo $question['difficulty'] == 'hard' ? 'selected' : ''; ?>>Hard</option>
        </select>
    </div>
    <?php foreach ($options as $index => $option) : ?>
        <div class="form-group">
            <label for="option<?php echo $index + 1; ?>">Option <?php echo $index + 1; ?>:</label>
            <div class="input-group">
                <input type="text" class="form-control" id="option<?php echo $index + 1; ?>" name="option[]" value="<?php echo $option; ?>" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <input type="radio" name="correctAnswer" value="<?php echo $index + 1; ?>" <?php echo ($index + 1) == $question['correctAnswer'] ? 'checked' : ''; ?>>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select class="form-control" id="category_id" name="category_id" required>
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $question['category_id'] ? 'selected' : ''; ?>><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update Question</button>
</form>

<?php
$title = "Edit Question";
$content = ob_get_clean();
require '../../../layout.php';
