<?php

if (isset($_COOKIE['font'])) {
    $font = $_COOKIE['font'];
}
if ($_SERVER['REQUEST_METHOD'] == "GET" || isset($_COOKIE['font'])) {
    if (isset($_GET["font"]) || isset($_COOKIE['font'])) {
        $font = isset($_GET["font"]) ? $_GET["font"] : $_COOKIE['font'];
        if ($font === "small") {
            $font = "20px";
        } else if ($font === "medium") {
            $font = "40px";
        } else if ($font === "big") {
            $font = "50px";
        }
        setcookie("font", $_GET["lang"], time() + 3600 * 24 * 30 * 6, "/");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div style="gap:15px;">
        <a href="?<?= http_build_query(array_merge($_GET, ['font' => 'small'])) ?>">Маленький шрифт</a>
        <a href="?<?= http_build_query(array_merge($_GET, ['font' => 'medium'])) ?>">Середній шрифт</a>
        <a href="?<?= http_build_query(array_merge($_GET, ['font' => 'big'])) ?>">Великий шрифт</a>
    </div>
    <div style="font-size:<?= $font ?>;">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam dicta inventore minima eveniet? Dignissimos
        voluptatibus quasi ex tempora rerum, accusantium vero nisi fugit unde architecto expedita cupiditate,
        distinctio, aperiam quos.
        Fugit et laborum sapiente quaerat asperiores distinctio temporibus odit vero nam placeat, veniam ut cupiditate
        quis maxime, illo ratione nulla! A cumque unde odit iure quisquam molestias soluta, excepturi voluptate!
    </div>
</body>

</html>