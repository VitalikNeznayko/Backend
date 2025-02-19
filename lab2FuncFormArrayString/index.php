<?php
include 'Templates/layout/header.php';

if(isset($_GET['page'])){
    $page = 'Templates/tasks/'.$_GET['page'].'.php';
    include $page;
}
include 'Templates/layout/footer.php';