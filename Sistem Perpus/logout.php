<?php
session_start();
session_destroy();
header("Location: login_admin1.php");
exit;
?>
