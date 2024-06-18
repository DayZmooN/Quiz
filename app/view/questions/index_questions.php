<?php
ob_start();
require_once '../../model/config.php';
require_once '../../model/questions/read.php';

// Récupérer les catégories existantes pour le filtre
$sql = "SELECT id, name FROM categories";
$result = $conn->query($sql);
$categories = $result->fetch_all(MYSQLI_ASSOC);

$difficulties = ["Easy", "Medium", "Hard"];
?>

<div class="container row mb-1 mt-1">
    <form method="GET" action="" class="form-inline">
        <div class="form-group mr-2">
            <label for="category_filter" class="mr-2">Filter by Category:</label>
            <select class="form-control" id="category_filter" name="category">
                <option value="">All Categories</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mr-2">
            <label for="difficulty_filter" class="mr-2">Filter by Difficulty:</label>
            <select class="form-control" id="difficulty_filter" name="difficulty">
                <option value="">All Difficulties</option>
                <?php foreach ($difficulties as $difficulty) : ?>
                    <option value="<?php echo $difficulty; ?>"><?php echo $difficulty; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mr-2">Apply Filters</button>
    </form>
    <a href="./form_add_questions.php" class="btn btn-primary mt-1 mb-1">Add Question</a>
</div>

<?php if (!empty($questions)) { ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Difficulty</th>
                <th scope="col">Category Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $question) : ?>
                <tr>
                    <td><?php echo $question['name']; ?></td>
                    <td><?php echo $question['difficulty']; ?></td>
                    <td><?php echo $question['category_name']; ?></td>
                    <td>
                        <a href="./form_update_questions.php?id=<?php echo $question['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="../../model/questions/delete.php?id=<?php echo $question['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
<?php } else { ?>
    <div class="alert alert-danger" role="alert">
        No questions found.
    </div>
<?php } ?>

<?php
$title = "Questions";
$content = ob_get_clean();
require '../../../layout.php';
