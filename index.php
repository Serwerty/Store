<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <LINK href="css/main.css" rel="stylesheet" type="text/css">
		<title>Store</title>
	</head>
	<body>
        <div class="header">
            <?php
            ob_start();
            session_start();
            include("header.php");
            ?>
        </div>
        <div class = "content">
            
        </div>
        <div class = "footer">
            <?php
            include ("footer.php");
            echo "test123";
            ?>
        </div>
    </body>
</html>