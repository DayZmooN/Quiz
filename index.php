<?php
ob_start();
require '../Quiz/app/model/config.php';
require './app/model/quizzes/read.php';
?>



<?php
$title = 'Home';
$content = ob_get_clean();
require 'layout.php';
?>