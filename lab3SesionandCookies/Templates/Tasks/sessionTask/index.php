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

    $current_url = $_SERVER['REQUEST_URI'];
    $url_parts = parse_url($current_url);
    parse_str($url_parts['query'] ?? '', $query_params);
    unset($query_params['logout']);

    $new_url = $url_parts['path'] . '?' . http_build_query($query_params);

    header('Location: ' . $new_url);
    die;
}

?>
<?php if (empty($_SESSION["is_logged"])) : ?>
    <?= $errormessage !== "" ? "<div style='color:red;'>$errormessage</div>" : "" ?>
    <form method="POST" action="">
        <table>
            <tr>
                <td>Login:</td>
                <td><input type="text" value="<?= $_POST["login"] ?>" name="login"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" value="<?= $_POST["password"] ?>" name="password"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit">Log in</button></td>
            </tr>
        </table>
    </form>
    
<?php else : ?>
    <div>Hello Admin</div>
    <a href="?<?= http_build_query(array_merge($_GET, ["logout" => 1])) ?>">Exit</a>
<?php
endif; ?>