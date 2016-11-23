<?php
include("../includes/connect.php");

try 
{
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT id FROM juices;"; 

     if (isset($_SESSION['cart']))
          unset($_SESSION['cart']);
    
    foreach ($conn->query($sql) as $row) 
    {
      if (isset($_SESSION['productID'.$row['id']]))
          unset($_SESSION['productID'.$row['id']]);
    }
 }
catch(PDOException $error)
{
    echo "<p>Error: ".$error->getMessage()."</p>\n";
}                 
            
?>