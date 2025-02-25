<?php
if (isset($_POST['login']) && isset($_POST['passwordUsers'])) {
    $login = 'Templates/Tasks/catalogTask/' . $_POST['login'];
    $password = $_POST['passwordUsers'];
    setcookie('password', $password, time() + 3600 * 60 * 24, '/');
    if (!file_exists($login)) {
        mkdir($login);
        mkdir($login . '/video');
        mkdir($login . '/music');
        mkdir($login . '/photo');
        echo "Папка створена успішно.";
        file_put_contents($login . "/video/video.txt", "video");
        file_put_contents($login . "/music/music.txt", "music");
        file_put_contents($login . "/photo/photo.txt", "photo");
    } else {
        echo "Папка з таким ім'ям вже існує.";
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
    <h4>Створення директорії</h4>

    <form action="" method="POST">
        <table>
            <tr>
                <td>Логін:</td>
                <td><input type="text" name="login"></td>
            </tr>
            <tr>
                <td>Пароль:</td>
                <td><input type="password" name="passwordUsers"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit">Send</button></td>
            </tr>
        </table>
    </form>
    <a href="/?Page=catalogTask/delete">Видалити</a>
</body>

</html>