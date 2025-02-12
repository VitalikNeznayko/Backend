<form method="post" action="#">
    <table>
        <tr>
            <td><label for="square">Введіть кількість квадратів: </label></td>
            <td><input type="number" value="<?= $_POST["square"] ?>" name="square"></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit">Генерування</button></td>
        </tr>
    </table>
</form>
<div class="block">
    <?php
    $countSquare = $_POST["square"];
    for ($i = 0; $i < $countSquare; $i++) {
        $size = mt_rand(20, 100);
        $maxLeft = 500 - $size;
        $maxTop = 500 - $size;
        $top = mt_rand(0, $maxTop);
        $left = mt_rand(0, $maxLeft);
        echo '<div class="square" style="width:' . $size . 'px; height:' . $size . 'px; top:' . $top . 'px; left:' . $left . 'px;"></div>';
    }
    ?>
</div>