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
                    
                    echo '<table class = "products" width="100%" >';
                           echo '<tr>
                                <th></th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Count</th>
                                <th>Cost</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>';
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
                    
                    $sql = "SELECT * FROM deliverytypes;"; 
                    
                    echo '
                    <form action="utility/tableHandler.php" method="POST">
                    <label for="deliveryId">Select delivery type:</label><br>
                    <select name="deliveryId" >';
                        foreach ($conn->query($sql) as $row) 
                        {   
                            echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                        }
                    echo '</select>
                    <input type="submit" value="Proceed to Checkout" name="submit_save" /></form>';
                    echo '<a href="index.php"><p style="padding-left: 20px;">Continue Shopping</p></a>' ;   
                    echo '</div>';
                     }
                    else
                    {
                        echo '<div class="empty_cart_text"><h1>You still got empty cart? Check out our products <a href="index.php">HERE</a></h1></div>';
                    }
                    
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