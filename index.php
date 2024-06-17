<?php
ob_start();
require_once './app/model/config.php';
?>

<?php
$title = 'Home';
$content = ob_get_clean();
require 'layout.php';
