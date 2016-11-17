<?php
           
$pages = array(
'index.php' => 'Home',
'about.php' => 'About Us',
'delivery.php'  => 'Delivery Options',
'cart.php'  => 'Cart'
);

   $pageName =  basename($_SERVER['PHP_SELF']);
echo "<menu>";
foreach ($pages as $key => $value)
{
    if ($key == "cart.php")
    {   
        if (isset($_SESSION['cart']))
            echo "<li><a href=".$key.">".$value." (".$_SESSION['cart'].")</a></li>"; 
        else
            echo "<li class=\"cart\"><a href=".$key.">".$value."</a></li>";  
    }
    else if ($key <> $pageName)
    {
        echo "<li><a href=".$key.">".$value."</a></li>";
    }
    else
    {
        echo "<li class=\"selected\"><a>".$value."</a></li>";   
    }
}


 if (isset($_SESSION['user_id'])) 
    {
        if ($pageName == 'signin.php' || $pageName == 'signup.php')
        {
            header('Location: '.'index.php', true, $permanent ? 301 : 302);
            exit();
        }
        
        else
        {
            echo "<li class = \"user_container\">Welcome, ".$_SESSION['username']."!</li>";
            echo "<li><a href=\"includes/logout.php\"> Logout</a></li>";
        }
	}  
else 
    {
        if ( $pageName != 'signup.php' && $pageName != 'signin.php')
        {
            header('Location: '.'signin.php', true, $permanent ? 301 : 302);
            exit();
        }
        
    }
echo "</menu>";
?>