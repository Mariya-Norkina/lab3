<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $bg = $_POST['bg'];
    $font = $_POST['font'];

    $stmt = $pdo->prepare("INSERT INTO users (username, password, bg_color, font_color) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $password, $bg, $font]);

    header("Location: login.php");
    exit;
}
?>

<form method="POST">
    <input name="username" placeholder="Логин" required><br>
    <input name="password" type="password" placeholder="Пароль" required><br>

    <label>Фон:</label>
    <input name="bg" type="color"><br>

    <label>Цвет текста:</label>
    <input name="font" type="color"><br>

    <button type="submit">Зарегистрироваться</button>
</form>