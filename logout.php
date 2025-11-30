<?php
session_start();

session_unset();
session_destroy();

setcookie("user_id", "", time() - 3600);
setcookie("bg", "", time() - 3600);
setcookie("font", "", time() - 3600);

header("Location: login.php");
exit;