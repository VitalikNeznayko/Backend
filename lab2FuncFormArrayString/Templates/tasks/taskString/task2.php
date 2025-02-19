<form action="" method="post">
    <table>
        <tr>
            <td><label for="city">City:</label></td>
            <td><input type="text" name="city" value="<?= $_POST["city"]?>"></input></td>
        </tr>

        <td></td>
        <td><button type="submit">Send</button></td>
        </tr>
    </table>
</form>
<?php
$city = $_POST["city"];
$city = explode(" ", $city);
sort($city);
$city = implode(" ", $city);
echo $city;