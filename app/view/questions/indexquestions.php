<?php
ob_start();
require_once '../../model/config.php';
require_once '../../model/questions/read.php';
?>
<a href="./form_add_questions.php" class="btn btn-primary">Add Question</a>
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
