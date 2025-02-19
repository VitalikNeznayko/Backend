<?php require_once('Function/func.php') ?>

<form action="" method="POST">
    <table>
        <tr>
            <td>x</td>
            <td>y</td>
        </tr>
        <tr>
            <td><input type="number" name="x" value="<?= $_POST["x"] ?>"></td>
            <td><input type="number " name="y" value="<?= $_POST["y"] ?>"></td>
            <td><button type="submit">=</button></td>
        </tr>
        <tr></tr>
    </table>
</form>
<?php require_once('calculate.php') ?>