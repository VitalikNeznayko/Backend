<?php
include 'Templates/Layout/header.php';

if (isset($_GET["Page"])) {
    $path = 'Templates/Tasks/' . $_GET["Page"] . ($_GET["Page"] == "catalogTask/delete" ?  '.php' : '/index.php');
    
    if (file_exists($path))
        include $path;
    else
        include 'Templates/Tasks/catalogTask/index.php';
} else {
    include 'Templates/error/404.php';
}

include 'Templates/Layout/footer.php';
