<?php
ob_start();
require_once '../../model/config.php';
require_once '../../model/questions/read.php';
?>
<?php if (!empty($questions)) { ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Difficulty</th>
                <th scope="col">Category Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $question) : ?>
                <tr>
                    <td><?php echo $question['name']; ?></td>
                    <td><?php echo $question['difficulty']; ?></td>
                    <td><?php echo $question['category_name']; ?></td>
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
$content = ob_get_clean();
require '../../../layout.php';
