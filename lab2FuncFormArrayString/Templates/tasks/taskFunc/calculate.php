<?php
require_once('Function/func.php');
$x = $_POST["x"];
$y = $_POST["y"];
?>

<table class="tbl-calc">
    <tr>
        <th>x^y</th>
        <th>x!</th>
        <th>my_tg(x)</th>
        <th>sin(x)</th>
        <th>cos(x)</th>
        <th>tg(x)</th>
    </tr>
    <tr>
        <td><?= calcPower($x, $y) ?></td>
        <td><?= calcfactorial($x) ?></td>
        <td><?= calcTg($x) ?></td>
        <td><?= calcSin($x) ?></td>
        <td><?= calcCos($x) ?></td>
        <td><?= calcTg($x) ?></td>
    </tr>
</table>