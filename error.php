<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Store</title>
   </head>
   <body>
      <div class = "container">
         <?php
            ob_start();
            session_start();
            echo "<p>Error: ".$_GET['error']."</p>";
         ?>
      </div>
   </body>
</html>
