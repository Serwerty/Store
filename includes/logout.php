<?php
    session_start();
    unset($_SESSION["user_id"]);
    unset($_SESSION["username"]);
    unset($_SESSION["email"]);
    header('Location: '.'signin.php', true, $permanent ? 301 : 302);
 ?>