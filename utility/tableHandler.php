<?php
ob_start();
session_start();

if (isset($_POST['submit'])) {
           PutInACart($_POST['submit'],$_POST['count']);
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
?>