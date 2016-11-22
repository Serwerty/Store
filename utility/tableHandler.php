<?php
ob_start();
session_start();

if (isset($_POST['submit'])) {
           PutInACart($_POST['submit'],$_POST['count']);
            }      
if (isset($_POST['submit_plus'])) {
           UpdateCart($_POST['submit_plus'],true);
            }   
if (isset($_POST['submit_minus'])) {
           UpdateCart($_POST['submit_minus'],false);
            }  
if (isset($_POST['submit_delete'])) {
           DeleteItemInCart($_POST['submit_delete']);
            } 
if (isset($_POST['submit_save'])) {
           SaveCart($_POST['deliveryId']);
    echo "123";
            } 
        
function PutInACart($id,$count)
{
    if($count === NULL) $count = 1;
    if (isset($_SESSION['user_id'])) 
    {
        if (isset($_SESSION['cart'])) 
            $_SESSION['cart']++;
        else
            $_SESSION['cart']=1;
        
        if (isset($_SESSION['productID'.$id.'']))
            $_SESSION['productID'.$id.'']+=$count;
        else
            $_SESSION['productID'.$id.'']=$count;
    }
    header('Location: ../index.php', true, $permanent ? 301 : 302);
    exit();
}

function UpdateCart($id,$isAddButton)
{
    if (isset($_SESSION['user_id'])) 
    {
        if ($isAddButton)
            $_SESSION['productID'.$id.'']++;
        else if ($_SESSION['productID'.$id.'']>0)
            $_SESSION['productID'.$id.'']--;
    }
    header('Location: ../cart.php', true, $permanent ? 301 : 302);
    exit();
}

function DeleteItemInCart($id)
{
    if (isset($_SESSION['user_id'])) 
    {
        if (isset($_SESSION['cart']))
        {
            if($_SESSION['productID'.$id.'']>0)
            $_SESSION['cart']--;
        }
        if (isset($_SESSION['productID'.$id.'']))
            unset($_SESSION['productID'.$id.'']);
    }
    header('Location: ../cart.php', true, $permanent ? 301 : 302);
    exit();
}

function SaveCart($deliveryID)
{
  if (isset($_SESSION['user_id'])) 
    {
        if (isset($_SESSION['cart']))
        {
         include("../includes/connect.php");
            try 
            {
                $conn = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
             $dateNow = date("Y-m-d H:i:s");
             $insertQuery = 'INSERT INTO Orders(date, user_id, delivery_type_id) VALUES("'.$dateNow.'",'.$_SESSION['user_id'].','.$deliveryID.')';
             $getIdQuery = 'Select id from orders where data = "'.$dateNow.'"';
             $orederId;
                echo $insertQuery;
             $conn->exec($insertQuery);
            
             foreach ($conn->query($getIdQuery) as $row) 
                 $orederId = $row['id'];
            
             $sql = "SELECT * FROM juices;"; 
             foreach ($conn->query($sql) as $row) 
             {
                if (isset($_SESSION['productID'.$row['id']]))
                {
                    $insertQueryOrderJuice = 'INSERT INTO OrderJuice(order_id, juice_id, count_of_juice) VALUES('.$orederId.','.$row['id'].','.$_SESSION['productID'.$row['id']].')';
                    $conn->exec($insertQueryOrderJuice);
                    echo $insertQueryOrderJuice;
                }
             }
          }
          catch(PDOException $error) 
          {
            echo "<p>Error: ".$error->getMessage()."</p>\n";
          }
            include("unSetCart.php"); 
                
        }
    } 
    //header('Location: ../index.php', true, $permanent ? 301 : 302);
    //exit();
}
?>