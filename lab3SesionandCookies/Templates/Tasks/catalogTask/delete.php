<?php
if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    function deleteDir($dirPath)
    {
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK); //пошук файлів, які знаходяться у даній директорії
        foreach ($files as $file) {
            if (is_dir($file)) {
                deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
    echo $passwordUsers;
    if (file_exists($login)) {
        deleteDir($login);
        echo "Папка вилучена успішно.";
    } else {
        echo "Введено не правильно назву папки";
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

</body>

</html>