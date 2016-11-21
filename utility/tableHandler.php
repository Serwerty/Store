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
?>