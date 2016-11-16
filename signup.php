<html>
    <head>
		<meta charset="utf-8">
		<title>Sign Up</title>
	</head>
	<body>
        <div class = "container">
            <?php
                ob_start();
                session_start();
                if (isset($_SESSION['user_id'])) {
				    header('Location: '.'index.php', true, $permanent ? 301 : 302);
				    exit();
			     }
                include("includes/connect.php");
            
                function startSession($userId, $username, $email) {
                    $_SESSION['valid'] = true;
                    $_SESSION['timeout'] = time();
                    $_SESSION['expire'] = $_SESSION['start']  + (1800);
                    $_SESSION['user_id'] = $userId;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                }
  
              function userExists($conn, $email) {
                 $sql = "SELECT * FROM users
                       WHERE email='".$email."';";
                 return $conn->query($sql)->fetchColumn() > 0;
              }
  
              function signUp($conn, $username, $email, $password, $confirm_password) {
                 $error = "";
  
                 if (strlen($username) == 0) {
                    $error = "Username can't be empty.";
                 }
                 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = "Email is invalid.";
                 }
                 if (strlen($password) < 6 || $password != $confirm_password) {
                    $error = "Passwords must be equal and length >= 6.";
                 }
                 if (userExists($conn, $email)) {
                    $error = "User with such email already exists.";
                 }
  
                 if ($error == "") {
                    $createUserSql = "INSERT INTO users (username, email, password)
                                VALUES ('".$username."', '".$email."', '".md5($password)."');";
                    $conn->exec($createUserSql);
                    startSession($conn->lastInsertId(), $username, $email);
                    header('Location: '.'index.php', true, $permanent ? 301 : 302);
                 } else {
                    header('Location: '.'error.php?error='.$error, true, $permanent ? 301 : 302);
                 }
                 exit();
              }
              
              if (isset($_POST['sign_up'])) {
                 try {
                     
                    $conn = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    signUp($conn, $_POST['username'], $_POST['email'], $_POST['password'],         $_POST['confirm_password']);
                 } catch(PDOException $error) {
                    echo "<p>Error: ".$error->getMessage()."</p>\n";
                 }
              }
           ?>
        </div>
        <div class = "container">
         <form action="signup.php" method="post">
            <fieldset>
               <p><input type="text" name="username" size="40" maxlength="40" placeholder="Username" /></p>
               <p><input type="email" name="email" size="40" maxlength="40" placeholder="Email" /></p>
               <p><input type="password" name="password" size="40" maxlength="40" placeholder="Password" /></p>
               <p><input type="password" name="confirm_password" size="40" maxlength="40" placeholder="Confirm password" /></p>
               <p><input type="submit" name="sign_up" value="Sign Up" /></p>
               <a href="signin.php">Already have an account? Sign In</a>
            </fieldset>
         </form>
      </div> 
    </body>
</html>