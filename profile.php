<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bg = $_POST['bg'];
    $font = $_POST['font'];

    $stmt = $pdo->prepare("UPDATE users SET bg_color = ?, font_color = ? WHERE id = ?");
    $stmt->execute([$bg, $font, $_SESSION['user_id']]);

    $_SESSION['bg'] = $bg;
    $_SESSION['font'] = $font;

    setcookie("bg", $bg, time()+3600*24*7);
    setcookie("font", $font, time()+3600*24*7);

    header("Location: index.php");
    exit;
}
?>

<form method="POST">
    <label>Фон:</label>
    <input name="bg" type="color" value="<?= $_SESSION['bg'] ?>"><br>

    <label>Цвет текста:</label>
    <input name="font" type="color" value="<?= $_SESSION['font'] ?>"><br>

    <button type="submit">Сохранить</button>
</form>