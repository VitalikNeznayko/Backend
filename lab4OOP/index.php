<?php
include 'Templates/Layout/header.php';

if (isset($_GET["Page"])) {
    $path = 'Templates/Tasks/' . $_GET["Page"] . '/index.php';
    
    if (file_exists($path))
        include $path;
    else
        include 'Templates/Tasks/task1-4/index.php';
    
}

include 'Templates/Layout/footer.php';
