<?php
unset($_SESSION);
unset($_COOKIE);
session_destroy();
header('Location: ../view/templates/login.php');
exit;
?>