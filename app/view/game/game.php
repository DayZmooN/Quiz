<?php
ob_start();
require $_SERVER['DOCUMENT_ROOT'] . '/Quiz/app/model/config.php';
$id = $_POST['id'];
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
?>
<div class="app"></div>

<?php
$title = 'game';
$content = ob_get_clean();
require '../../../layout.php';
