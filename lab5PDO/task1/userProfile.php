<?php

session_start();

/**
 * Перевіряє, чи відбувся вхід користувача в систему, якщо користувач не увійшов або сесія закінчилася, перенаправляє на сторінку входу.
 * В іншому випадку повертає дані про користувача.
 *
 * @return array Дані користувача, які були зчитані з бази даних.
 */     
function checkLogged(): ?array
{
    if (!isset($_SESSION["logged"]) || !isset($_SESSION["login"])) {
        header("Location: login.php");
        die;
    } else {
        $dsn = "mysql:host=localhost;dbname=lab5";
        $pdo = new PDO($dsn, "root", "");
        
        $login = $_SESSION["login"];
        $sql = "SELECT * FROM users  WHERE login = :login LIMIT 1";
        $sth = $pdo->prepare($sql);
        $sth->bindValue(":login", $login);
        $sth->execute();

        $userData = $sth->fetch(PDO::FETCH_ASSOC);
        if (!is_array($userData)) {
            return [];
        }
        return $userData;
        
    }
}

$accountData = checkLogged();
var_dump($accountData);
foreach ($accountData as $key => $value) {
    $$key = $value;
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $dsn = "mysql:host=localhost;dbname=lab5";
    $pdo = new PDO($dsn, "root", "");
    if (isset($_POST["edit"])) {
        $set = "";
        $formData = [];
        foreach ($_POST as $key => $value) {
            if (strlen($value) > 0 && $key !== 'edit') {
                $$key = $value;
                $formData[$key] = $value;
            }
        }
        foreach ($formData as $key => $value) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ', ');
        $sqlChange = "UPDATE users SET $set WHERE id = :id";
        $sthChange = $pdo->prepare($sqlChange);
        foreach ($formData as $key => $value)
            $sthChange->bindValue(":$key", $$key);
        $sthChange->bindValue(":id", $id);
        $_SESSION['login'] = $formData['login'];
        $sthChange->execute();
        header('Location: userProfile.php');
        die;

    }
    if (isset($_POST['exit'])) {
        session_destroy();
        header('Location: login.php');
    }
    if (isset($_POST['delete'])) {
        $sqlDelete = "DELETE FROM users WHERE id = :id";
        $sthDelete = $pdo->prepare($sqlDelete);
        $sthDelete->bindValue(":id", $accountData['id']);
        $sthDelete->execute();

        session_destroy();
        header('Location: login.php');
        die;
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
    <form method="POST">
        <table>
            <tr>
                <td>Привіт, <?= $name ?> </td>
                <td><input type="submit" value="Exit" name="exit"></td>
            </tr>
            <tr>
                <td>Name</td>
                <td>Login</td>
                <td>Password</td>
            </tr>
            <tr>
                <td><input type="text" name="name" value="<?= $name ?>"></td>
                <td><input type="text" name="login" value="<?= $login ?>"></td>
                <td><input type="text" name="password" value="<?= $password ?>"></td>
                <td><input type="submit" value="Edit" name="edit"></td>
            </tr>
            <tr>
                <td><input style="color: red;" type="submit" value="Delete account" name="delete"></td>

            </tr>
        </table>
    </form>
</body>

</html>