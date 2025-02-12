<?php
include 'Templates/Layout/header.php';

if (isset($_GET["Task"])) {
    $path = 'Templates/Tasks/' . $_GET["Task"].'.php';
    if (file_exists($path)) {
        include $path;
    } else {
        include "Templates/error/404.php";
    }
} else {
    include 'Templates/Tasks/Task1.php';
}

include 'Templates/Layout/footer.php';