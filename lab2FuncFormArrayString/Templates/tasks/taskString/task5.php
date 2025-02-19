<form action="" method="post">
    <table>
        <tr>
            <td><label for="lenght">Введіть довжину генерованого паролю:</label></td>
            <td><input type="number" name="length" value="<?= $_POST['length']?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit">Генерування паролю</button></td>
        </tr>
    </table>
</form>
<?php
$lengthPassword = (int)$_POST["length"]; // довжина генерованого пароля
function GeneratePassword($lengthPassword): string
{
    $minLengthPassword = 2;
    $symbols = ["!@#%^()_+-=|\/,./';:", "ABCDEFGHIJKLMNOPQRSTUVWXYZ", "abcdefghijklmnopqrstuvwxyz", "1234567890"];
    shuffle($symbols);
    $password = "";
    foreach ($symbols as $symbol) {
        $amountRand = rand(1, min($lengthPassword - strlen($password), $minLengthPassword));
        $rand = str_shuffle($symbol); // перемішування символів в рандомному порядку
        $tmp = substr($rand, 0, $amountRand); // обрання символів з можливих
        $password .= $tmp;
    }
    // Додавання додаткових символів, якщо довжина пароля менша за очікувану
    while (strlen($password) < $lengthPassword) {
        $symbolSet = $symbols[array_rand($symbols)]; // вибір випадкового набору символів
        $rand = str_shuffle($symbolSet); // перемішування символів в рандомному порядку
        $tmp = substr($rand, 0, min($lengthPassword - strlen($password), strlen($rand))); // обрання символів з можливих
        $password .= $tmp;
    }

    return $password;
}

function CheckPassword($password, $lengthPassword): bool
{
    if (!preg_match("/[A-Za-z]/", $password)) { // не містить літер
        return false;
    } else if (!preg_match('/\d/', $password)) { // не містить цифр
        return false;
    } else if (!preg_match('/[^a-zA-Z0-9]/', $password)) { // не містить спеціальних символів
        return false;
    } else if ($lengthPassword < 6) {
        return false;
    }
    return true;
}
if ((int)isset($_POST['length']) > 0) {
    $password = GeneratePassword($lengthPassword);
    echo "Згенерований пароль: " . $password;
    if (CheckPassword($password, $lengthPassword)) {
        echo  "<div style='font-size:20px; color:green;'>Пароль достатньо міцний!</div>";
    } else
        echo  "<div style='font-size:20px; color:red;'>Пароль не достатньо міцний!!!!</div>";
}