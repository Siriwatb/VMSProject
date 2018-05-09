<?php
 session_start();
 unset($_SESSION['user_session']);
 header("Location: index.php");
?>
