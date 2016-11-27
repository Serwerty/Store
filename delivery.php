<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <LINK href="css/main.css" rel="stylesheet" type="text/css">
		<title>Jus Santé</title>
	</head>
	<body>
        <div class="header">
            <?php
            ob_start();
            session_start();
            include("includes/header.php");
            ?>
        </div>
        <div class = "content">
         <?php
            include('includes/connect.php');
            try 
            {
                $conn = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->exec("SET NAMES utf8");
                $conn->exec("SET CHARACTER SET utf8");
              
                
                $stmt = $conn->prepare("SELECT COUNT(*) FROM deliverytypes;"); 
                $stmt->execute(); 
                $deliveryCount = $stmt->fetch()['COUNT(*)'];
                
                $sql = "Select * from deliverytypes";
                
                echo '<h1>Nous avons obtenu '.$deliveryCount.' types de livraison:</h1>';
                echo '<div class="deliveries_table">';
               
                foreach ($conn->query($sql) as $row)
                {   
                    echo '<div class="delivery_type">';
                    echo '<strong>'.$row['name'].'</strong>';
                    echo '<strong>Price: </strong>'.$row['price'].'';
                    echo '<p>'.$row['description'].'</p>';
                    echo '</div>';
                }
                echo '</div>';
                
                
            }
            catch(PDOException $error)
            {
                echo "<p>Error: ".$error->getMessage()."</p>\n";
            }    

            ?>
        </div>
        <div class = "footer">
            <?php
            include ("includes/footer.php");
            ?>
        </div>
    </body>
</html>