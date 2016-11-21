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
            include("includes/header.php");
            ?>
        </div>
        <div class = "content">
            <?php
            include("includes/connect.php");
                try 
                {
                    $conn = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "SELECT * FROM juices;"; 

                     if (isset($_SESSION['cart']))
                     {
                         if ($_SESSION['cart'] == 1)
                            echo "<h2>You got 1 Item in cart</h2>";
                         else
                            echo "<h2>You got ".$_SESSION['cart']." Items in cart</h2>";
                     }
                    echo '<table class = "products" width="100%" >';
                    foreach ($conn->query($sql) as $row) 
                    {
                    
                      if (isset($_SESSION['productID'.$row['id']]))
                      {
                            echo '<tr>
                                    <td class = "table_image"><img src = "'.$row['image_path'].'"/></td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['price'].'</td>
                                    <td>'.$_SESSION['productID'.$row['id']].'</td>
                                    <td>'.$row['price'] * $_SESSION['productID'.$row['id']].'</td>';
                            echo '<form action="utility/tableHandler.php" method="post">';
                            echo '<td class = "table_input"><input class= "table_button" type="image" name="submit_plus" src="images/plus_button.png" border="0" alt="Submit" width="40"
                            height="40" align ="middle" value="'.$row['id'].'"</td>';
                            echo '<td class = "table_input"><input class= "table_button" type="image" name="submit_minus" src="images/minus_button.png" border="0" alt="Submit" width="40" height="40" align ="middle" value="'.$row['id'].'"</td>';
                            echo '<td class = "table_input"><input class= "table_button" type="image" name="submit_delete" src="images/cross_button.png" border="0" alt="Submit" width="40"
                            height="40" align ="middle" value="'.$row['id'].'"</td></tr>';
                            echo '</form>';
                      }
                    }
                    echo '</table>';
                    echo '<div>';
                    
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