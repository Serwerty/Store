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
    if ($key <> $pageName)
    {
        echo "<li><a href=".$key.">".$value."</a></li>";
    }
    else
    {
        echo "<li><a class=\"selected\">".$value."</a></li>";   
    }
}

 if (isset($_SESSION['user_id'])) {
				echo "<li class =  \"user_container\"><p>Welcome, ".$_SESSION['username']."!</p></li>";
			} else {
				header('Location: '.'signin.php', true, $permanent ? 301 : 302);
				exit();
			}
echo "</menu>";
?>