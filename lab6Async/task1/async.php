<?php
$data = file_get_contents("php://input");
$json = json_decode($data);
$dsn = "mysql:host=localhost;dbname=lab6";

foreach ($json as $key => $value) {
    if (strlen($value) > 0) {
        $$key = $value;
    }
}
if ($action === "register") {
    if (isset($login) && isset($password)) {
        if (strlen($password) < 8) {
            echo "Password is too short, minimum 8 characters";
            return;
        }

        try {
            $pdo = new PDO($dsn, 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM users WHERE login = :login";
            $sth = $pdo->prepare($sql);
            $sth->bindValue(":login", $login);
            $sth->execute();
            $alreadyExist = $sth->rowCount() > 0 ? true : false;

            if ($alreadyExist) {
                echo "Login already exists";
                return;
            }
            $sql = "SELECT * FROM users WHERE email = :email";
            $sth = $pdo->prepare($sql);
            $sth->bindValue(":email", $email);
            $sth->execute();
            $alreadyExist = $sth->rowCount() > 0 ? true : false;

            if ($alreadyExist) {
                echo "Email already exists";
                return;
            }
            $values = [
                "id" => null,
                "email" => $email,
                "login" => $login,
                "password" => $password,
            ];
            register($pdo, $values);
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            return;
        }
    } else {
        echo "No login or password was entered";
    }
} else if ($action === "logIn") {
    if (isset($login) && isset($password)) {
        try {
            $pdo = new PDO($dsn, 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return;
        }

        $values = [
            "login" => $login,
            "password" => $password,
        ];
        login($pdo, $values);
    } else {
        echo "Missing login or password";
    }
} else if ($action === "logOut-button") {
    session_start();
    session_destroy();
} else if ($action === "getContent") {

    try {
        $pdo = new PDO($dsn, 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e->getMessage();
        return;
    }

    getContent($pdo);
} else if ($action === "delete") {
    try {
        $pdo = new PDO($dsn, 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e->getMessage();
        return;
    }

    $sql = "DELETE FROM users WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->bindValue(":id", $id);
    $sth->execute();
} else if ($action === "edit") {
    try {
        $pdo = new PDO($dsn, 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e->getMessage();
        return;
    }

    $sql = "UPDATE users SET login = :login, password = :password, email = :email WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->bindValue(":id", $id);
    $sth->bindValue(":login", $login);
    $sth->bindValue(":password", $password);
    $sth->bindValue(":email", $email);

    $sth->execute();
}
function register($pdo, $values)
{
    $sql = "INSERT INTO users (email, login, password) VALUES (:email, :login, :password)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $values['email']);
    $stmt->bindParam(':login', $values['login']);
    $stmt->bindParam(':password', $values['password']);

    $stmt->execute();
    echo "register";
}
function login($pdo, array $values)
{
    $sql = "SELECT * FROM users WHERE login = :login LIMIT 1";
    $sth = $pdo->prepare($sql);
    $sth->execute(["login" => $values["login"]]);

    $user = $sth->fetch(PDO::FETCH_ASSOC);

    if ($user && $values["password"] === $user["password"]) {
        session_start();
        $_SESSION["logged"] = true;
        $_SESSION["login"] = $user["login"];

        echo "Logged succesfully";
    } else {
        echo "Wrong login or password";
    }
}

function getContent($pdo)
{
    $sql = "SELECT * FROM users ORDER BY id ASC";
    $stmt = $pdo->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}
