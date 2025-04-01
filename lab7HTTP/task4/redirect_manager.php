<?php
ob_start();

$redirects = json_decode(file_get_contents("redirects.json"), true);
$request_url = str_replace("/task4", "", $_SERVER['REQUEST_URI']);

if (isset($redirects[$request_url])) {
    $new_url = $redirects[$request_url];

    if ($new_url == "/404") {
        header("Location: /task4/404.php", true, 301);
    } else {
        header("Location: /task4" . $new_url . ".php", true, 301);
    }
    exit;
}


http_response_code(200);
include("index.php");
