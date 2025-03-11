<?php
session_start();

if (isset($_SESSION["logged"]) && $_SESSION["login"]) {
    header("Location: userProfile.php");
    die;
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $check = true;
    $formData = [];
    foreach ($_POST as $key => $value) {
        if (strlen($value) > 0) {
            $$key = $value;
            $formData[$key] = $value;
        } else {
            echo "Ви не ввели всі значення";
            $check = false;
            break;
        }
    }
    if ($check) {
        $dsn = "mysql:host=localhost;dbname=lab5";
        $pdo = new PDO($dsn, "root", "");
        $sql = "SELECT * FROM users WHERE login = :login AND password = :password";
        $sth = $pdo->prepare($sql);
        foreach ($formData as $key => $value) {
            $sth->bindValue(":$key", $$key);
        }
        $sth->execute();
        if ($sth->rowCount() == 1) {
            $_SESSION['logged'] = 1;
            $_SESSION['login'] = $login;
            header("Location: userProfile.php");
            die;
        }else{
            echo "Введено не вірно логін або пароль!";
        }
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
    <form action="" method="POST">
        <table>
            <tr>
                <td>Login:</td>
                <td><input type="text" name="login" id=""></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" id=""></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit">Log in</button></td>
            </tr>
        </table>
    </form>

    <div>
        Немає аккаунту?
        <a href="register.php">Зареєструватись</a>
    </div>
</body>

</html>