<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <LINK href="css/main.css" rel="stylesheet" type="text/css">
		<title>Store</title>
	</head>
	<body>
<?php
    session_start();
    unset($_SESSION["user_id"]);
    unset($_SESSION["username"]);
    unset($_SESSION["email"]);
    include('../utility/unSetCart.php');
    header('Location: ../signin.php', true, $permanent ? 301 : 302);
    exit();
 ?>
    </body>
</html>