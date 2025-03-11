<?php

// function autoload($class)
// {
//     $nameFolder = explode("User", $class);
//     $path = $nameFolder[1] . "/$class.php";

//     if (file_exists($path))
//         require_once($path);
// }
// spl_autoload_register("autoload");

function autoload($class)
{
    str_replace('\\', '/', $class);
    $path = "Templates/Tasks/task1-4/$class.php";

    if (is_file($path))
        require_once($path);
}
spl_autoload_register("autoload");
