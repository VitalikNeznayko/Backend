<?php
if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $cookieName = "password_" . $login;

    function deleteDir($dirPath)
    {
        global $login;
        if (isset($_COOKIE["password$login"])) {
        }
        $files = glob($dirPath . '/*', GLOB_MARK); //пошук файлів, які знаходяться у даній директорії

        if ($files === false) {
            echo "Помилка при отриманні файлів.";
            return;
        }

        foreach ($files as $file) {
            if (is_dir($file)) {
                deleteDir($file);
            } else {
                unlink($file);
            }
        }

        rmdir($dirPath);
    }

    $dirPath = "Templates/Tasks/catalogTask/" . $login;
    if (isset($_COOKIE[$cookieName]) && $_COOKIE[$cookieName] == $password) {
        if (file_exists($dirPath) && is_dir($dirPath)) {
            deleteDir($dirPath);
            echo "Папка вилучена успішно.";
            setcookie($cookieName, "", time() - 3600, "/");
        } else {
            echo "Введено не правильно назву папки";
        }
    } else {
        echo "Введено не правильний пароль";
    }
}
?>

<h4>Видалення директорії</h4>
<form action="" method="post">
    <table>
        <tr>
            <td>Логін:</td>
            <td><input type="text" name="login"></td>
        </tr>
        <tr>
            <td>Пароль:</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit">Send</button></td>
        </tr>
    </table>
</form>
<a href="/?Page=catalogTask">Створити</a>