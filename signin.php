<html>
	<head>
		<meta charset="utf-8">
        <LINK href="css/main.css" rel="stylesheet" type="text/css">
		<title>Sign In</title>
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

            function startSessionForUser($userId, $username, $email) {
               $_SESSION['valid'] = true;
               $_SESSION['timeout'] = time();
               $_SESSION['expire'] = $_SESSION['start'] + (1800);
               $_SESSION['user_id'] = $userId;
               $_SESSION['username'] = $username;
               $_SESSION['email'] = $email; 
            }

            function signIn($conn, $email, $password) {
               $sql = "SELECT * FROM users
                     WHERE email='".$email."' AND password='".md5($password)."';";
               $result = $conn->query($sql);

               if ($result->rowCount() > 0) {
                  $row = $result->fetch();
                  startSessionForUser($row['id'], $row['username'], $row['email']);
                  header('Location: '.'index.php', true, $permanent ? 301 : 302);
               } else {
                  header('Location: '.'error.php?error=User credentials are invalid.', true, $permanent ? 301 : 302);
               }
               exit();
            }
            
            if (isset($_POST['signin'])) {
               try {
                    $conn = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                    signIn($conn, $_POST['email'], $_POST['password']);
               } catch(PDOException $error) {
                  echo "<p>Error: ".$error->getMessage()."</p>\n";
               }
            }
         ?>
         <form action="signin.php" method="post">
               <p><input type="email" name="email" size="40" maxlength="40" placeholder="Email" /></p>
               <p><input type="password" name="password" size="40" maxlength="40" placeholder="Password" /></p>
               <p><input type="submit" name= "signin" value="Sign In" /></p>
               <a href="signup.php">Don't have an account? Sign Up</a>
         </form>
      </div> 
    </body>
</html>