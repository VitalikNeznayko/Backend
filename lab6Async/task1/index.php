<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="register">
        <table id="table-register">
            <tr>
                <td>Email:</td>
                <td><input type="text" name="reg-email" id="reg-email" required></td>
            </tr>
            <tr>
                <td>Login:</td>
                <td><input type="text" name="reg-login" id="reg-login" required></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="reg-password" id="reg-password" required></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="button" id="reg-button">Register</button></td>
            </tr>
            <tr>
                <td>Вже є аккаунт?</td>
                <td>
                    <button type="button" id="show-logIn">Увійти</button>
                </td>
            </tr>
            <tr>
                <td></td>
                <td id="log-error"></td>
            </tr>
        </table>
    </div>
    <div id="logIn">
        <table id="table-logIn">
            <tr>
                <td>Login:</td>
                <td><input type="text" name="logIn-login" id="logIn-login" required></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="logIn-password" id="logIn-password" required></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="button" id="logIn-button">LogIn</button></td>
            </tr>
            <tr>
                <td>Немає аккаунта?</td>
                <td>
                    <button type="button" id="show-register">Зареєструватися</button>
                </td>
            </tr>
            <tr>
                <td></td>
                <td id="log-error"></td>
            </tr>
        </table>
    </div>
    <div id="userProfile">
        <table id="bdtable">
        </table>
        <button type="button" id="update-button">Оновити</button>
        <button type="button" id="logOut-button">Вихід</button>

    </div>
</body>
<script src="task1\js\async.js"></script>

</html>