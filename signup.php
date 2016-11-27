<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
        <LINK href="css/main.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="images/Icon.png">
		<title>Sign Up</title>
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
                    $error = "Nom ne doit pas être vide";
                 }
                 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = "E-mail n'est pas valable.";
                 }
                 if (strlen($password) < 6 || $password != $confirm_password) {
                    $error = "Mots de passe doivent être éguaux et longueur > 5.";
                 }
                 if (userExists($conn, $email)) {
                    $error = "Utilisateur avec cet e-mail existe déjà.";
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
         <h1>Signer</h1>
         <form action="signup.php" method="post">
               <p><input type="text" name="username" size="40" maxlength="40" placeholder="Nom d'utilisateur" /></p>
               <p><input type="email" name="email" size="40" maxlength="40" placeholder="Email" /></p>
               <p><input type="password" name="password" size="40" maxlength="40" placeholder="Mot de passe" /></p>
               <p><input type="password" name="confirm_password" size="40" maxlength="40" placeholder="Confirmer le mot de passe" /></p>
               <p><input type="submit" name="sign_up" value="Signer" /></p>
               <a href="signin.php">Avez-vous déjà un compte? Entrer</a>
         </form>
      </div> 
        <div class = "footer">
            <?php
            include ("includes/footer.php");
            ?>
        </div>
    </body>
</html>