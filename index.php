<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Store</title>
	</head>
	<body>
        
        <div class = "container">
         <?php
            ob_start();
            session_start();
            if (isset($_SESSION['user_id'])) {
				echo "<p>Welcome, ".$_SESSION['username']."!</p>";
			} else {
				header('Location: '.'signin.php', true, $permanent ? 301 : 302);
				exit();
			}
         ?>
      	</div>
        <div class="menu">
        
        </div>
    </body>
</html>