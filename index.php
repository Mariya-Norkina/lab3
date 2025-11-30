<?php
require 'vendor/autoload.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$bg = $_SESSION['bg'] ?? "#ffffff";
$font = $_SESSION['font'] ?? "#000000";
?>

<body style="background: <?= $bg ?>; color: <?= $font ?>;">
<h1>Добро пожаловать!</h1>

<a href="profile.php">Настройки</a><br>
<a href="logout.php">Выйти</a>

</body>