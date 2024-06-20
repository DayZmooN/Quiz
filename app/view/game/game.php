<?php
ob_start();
require $_SERVER['DOCUMENT_ROOT'] . '/Quiz/app/model/config.php';

?>
<div class="app"></div>

<?php
$title = 'game';
$content = ob_get_clean();
require '../../../layout.php';
