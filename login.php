<?php
require 'db.php';
session_start();


if (!isset($_SESSION['user_id']) && isset($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['bg'] = $_COOKIE['bg'];
    $_SESSION['font'] = $_COOKIE['font'];
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // SESSION
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['bg'] = $user['bg_color'];
        $_SESSION['font'] = $user['font_color'];

        // COOKIES на 7 дней
        setcookie("user_id", $user['id'], time()+3600*24*7);
        setcookie("bg", $user['bg_color'], time()+3600*24*7);
        setcookie("font", $user['font_color'], time()+3600*24*7);

        header("Location: index.php");
        exit;
    } else {
        echo "Неверный логин или пароль";
    }
}
?>

<form method="POST">
    <input name="username" placeholder="Логин" required><br>
    <input name="password" type="password" placeholder="Пароль" required><br>
    <button type="submit">Войти</button>
</form>