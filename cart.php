<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <LINK href="css/main.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="images/Icon.png">
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
            include("includes/connect.php");
                try 
                {
                    $conn = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "Select juices.id, juices.name, juices.price, juices.image_path, manufacturers.name as manufacturer_name from juices, manufacturers 
                    where juices.manufacturer_id = manufacturers.id;"; 

                     if (isset($_SESSION['cart']))
                     {
                         if ($_SESSION['cart'] == 1)
                            echo "<h1>Vous avez un article dans votre panier</h1>";
                         else
                            echo "<h1>Vous avez ".$_SESSION['cart']." articles dans votre panier</h1>";
                    
                    echo '<table class = "products" width="100%" >';
                           echo '<tr>
                                <th></th>
                                <th>Nom (Fabricant)</th>
                                <th>Prix</th>
                                <th>Compter</th>
                                <th>Sous-Total</th>
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
                                    <td>'.$row['name'].' ('.$row['manufacturer_name'].')</td>
                                    <td>$'.$row['price'].'</td>
                                    <td>'.$_SESSION['productID'.$row['id']].'</td>
                                    <td>$'.$row['price'] * $_SESSION['productID'.$row['id']].'</td>';
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
                    <label for="deliveryId">Sélectionnez le type de livraison:</label><br>
                    <select name="deliveryId" >';
                        foreach ($conn->query($sql) as $row) 
                        {   
                            echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                        }
                    echo '</select>
                    <input type="submit" value="Passer à la caisse" name="submit_save" /></form>';
                    echo '<a href="index.php"><p style="padding-left: 20px;">Continuer Achats</p></a>' ;   
                    echo '</div>';
                     }
                    else
                    {
                        echo '<div class="empty_cart_text"><h1>Votre panier est encore vide? Cherchez nos produits <a href="index.php">ICI</a></h1></div>';
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