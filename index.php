    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <link href="css/main.css" rel="stylesheet" type="text/css">
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
            <!--<div style= "display: block; width: 90%; min-width: 90%; margin: auto">
                <img style="width: 100% " src="images/products.png"/>
            </div>-->
            <div class = "content">
                <?php
                include ("includes/connect.php");
                include ("includes/constants.php");
                try {

                        $conn = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        GenerateContent($conn);
                    }
                catch(PDOException $error) 
                    {
                        echo "<p>Error: ".$error->getMessage()."</p>\n";
                    }

                function GenerateContent($conn)
                {
                    global $ITEMS_PER_PAGE;
                    $page =  @$_GET["page"]; 
                    if (!isset($page))
                        $page = 1;
                    if ($page <= 0)
                        $page = 1;

                    echo "<h1>Produits</h1>";
                    $stmt = $conn->prepare("SELECT COUNT(*) FROM juices;"); 
                    $stmt->execute(); 
                    $maxPage = $stmt->fetch()['COUNT(*)'] / $ITEMS_PER_PAGE;
                           if ($page > $maxPage)
                        $page = $maxPage;

                    GetTable($conn, $page);


                    include ('utility/pageSelector.php');
                    selectPage($page,$maxPage);
                }

                function GetTable($conn,$page)
                {
                    global $ITEMS_PER_PAGE;

                        $sql = "Select juices.id, juices.name, juices.price, juices.image_path, manufacturers.name as manufacturer_name from juices, manufacturers 
                        where juices.manufacturer_id = manufacturers.id LIMIT ".($page-1) * $ITEMS_PER_PAGE.",".$ITEMS_PER_PAGE.";";

                        echo '<table class = "products" width="100%" >';
                        echo '<tr>
                                    <th></th>
                                    <th>Nom (Fabricant)</th>
                                    <th>Prix</th>
                                    <th>Compter</th>
                                    <th></th>
                                </tr>'; 
                            foreach ($conn->query($sql) as $row) 
                            { 
                                echo '<tr>
                                        <td class = "table_image"><img src = "'.$row['image_path'].'"/></td>
                                        <td>'.$row['name'].' ('.$row['manufacturer_name'].')</td>
                                        <td>$'.$row['price'].'</td>';
                                echo '<form action="utility/tableHandler.php" method="post">
                                        <td class = "table_input"><input type="number" name="count" size="60" min="1" max="100" title="number from 1 to 100" /></td>
                                        <td class = "table_image">
                                        <input class= "table_button" type="image" name="submit" src="images/plus_button.png" border="0" alt="Submit" width="40" height="40" align ="middle" value="'.$row['id'].'"/>
                                       </td>';
                                echo '</form>
                                    </tr>';
                            }
                        echo '</table>';
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