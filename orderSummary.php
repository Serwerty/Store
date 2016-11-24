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
            $orderId = @$_GET["orderId"]; 
            if (is_numeric($orderId))
            {
                try 
                {
                    $conn = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $stmt = $conn->prepare("SELECT orders.id, orders.user_id, orders.date, deliverytypes.name, deliverytypes.price FROM orders, deliverytypes
                    WHERE orders.delivery_type_id = deliverytypes.id AND orders.id =".$orderId.";"); 
                    
                    $stmt->execute(); 
                    $order = $stmt->fetch();
                    
                    if (!empty($order))
                    {
                        if ($order['user_id'] == $_SESSION['user_id'])
                        {
                        echo '<h1>Your Order #'.$order['id'].' has been successfully placed</h1>';
                        echo '<strong>Order Data : </strong>'.$order['date'].'<br>';
                            
                        $sql = 'SELECT juices.name, juices.price, juices.image_path, manufacturers.name as manufacturer_name, orderjuice.count_of_juice from juices, manufacturers, orderjuice
                        WHERE juices.id = orderjuice.juice_id and manufacturers.id = juices.manufacturer_id and orderjuice.order_id = '.$order['id'].';';
                            
                        echo '<table class = "products" width="100%" >';
                        echo '<tr>
                                <th></th>
                                <th>Name (Manufacturer)</th>
                                <th>Price</th>
                                <th>Count</th>
                                <th>Cost</th>
                            </tr>';
                        $totalCost = 0;
                        foreach ($conn->query($sql) as $row) 
                        {
                            $cost = $row['price'] * $row['count_of_juice'];
                            $totalCost += $cost;
                            echo '<tr>
                                        <td class = "table_image"><img src = "'.$row['image_path'].'"/></td>
                                        <td>'.$row['name'].'('.$row['manufacturer_name'].')</td>
                                        <td>'.$row['price'].'</td>
                                        <td>'.$row['count_of_juice'].'</td>
                                        <td>'.$cost.'</td></tr>';   
                        }
                        echo '</table>';
                        
                        echo '<strong>Delivery Type: </strong>'.$order['name'].'<br>';
                        echo '<strong>Delivery Price: </strong>'.$order['price'].'<br>';
                        $totalCost += $order['price'];
                        echo '<h2>Total Cost: '.$totalCost.'</h2>';
                        }
                        else
                        {
                            echo '<h1>Order with this number doesn\'t belong to you.</h1>';
                        }
                    }
                    else
                    {
                     echo '<h1>Order with this number doesn\'t exist.</h1>';   
                    }
                }
                catch(PDOException $error) 
                {
                    echo "<p>Error: ".$error->getMessage()."</p>\n";
                }
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