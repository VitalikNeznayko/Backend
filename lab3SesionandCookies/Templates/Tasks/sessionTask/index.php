<?php
session_start();
$errormessage = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST["login"];
    $password = $_POST["password"];
    if ($login === 'Admin' && $password === 'password')
        $_SESSION['is_logged'] = true;
    else
        $errormessage = "Не вірно введений пароль або логін";
}

if (isset($_GET['logout'])) {
    unset($_SESSION['is_logged']);
    header('Location: /');
    die;
}
?>
<?php if (empty($_SESSION["is_logged"])) : ?>
    <?= $errormessage !== "" ? "<div style='color:red;'>$errormessage</div>" : "" ?>
    <form method="POST" action="">
        <table>
            <tr>
                <td>Login:</td>
                <td><input type="text" name="login"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit">Log in</button></td>
            </tr>
        </table>
    </form>
<?php else : ?>
    <div>Hello Admin</div>
    <a href="?logout=1">Exit</a>
<?php
endif; ?>