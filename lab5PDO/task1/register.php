<?php
session_start();

if (isset($_SESSION["logged"]) && $_SESSION["login"]){
    header("Location: userProfile.php");
    die;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
        $sql = "SELECT * FROM users WHERE login = :login";
        $sth = $pdo->prepare($sql);
        $sth->bindValue(":login", $login);
        $sth->execute();
        if ($sth->rowCount() == 0) {
            $sql  = "INSERT INTO users VALUES(NULL ,:name, :login, :password)";
            $sth = $pdo->prepare($sql);
            foreach ($formData as $key => $value) {
                $sth->bindParam(":$key", $$key);
            }
            $sth->execute();
            $_SESSION["logged"] = 1;
            $_SESSION["login"] = $login;
            header("Location: login.php");
            die;
        } else {
            echo "Такий логін вже існує";
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
    <form action="" method="post">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" id="" value="<?php if (isset($_POST['name']) && $_POST['name'] != "") echo $name; ?>"></td>
            </tr>
            <tr>
                <td>Login:</td>
                <td><input type="text" name="login" value="<?php if (isset($_POST['login']) && $_POST['login'] != "") echo $login; ?>"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" id="" value="<?php if (isset($_POST['password']) && $_POST['password'] != "") echo $password; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit">Register</button></td>
            </tr>
        </table>
    </form>
    <div>
        Вже є аккаунт?
        <a href="login.php">Увійти</a>
    </div>
</body>

</html>