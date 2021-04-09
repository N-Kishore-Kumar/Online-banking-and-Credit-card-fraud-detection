<?php
require_once "../pdo.php";
session_start();

unset($_SESSION['name']);
unset($_SESSION['user_id']);

$salt='XyZzy12*_';
date_default_timezone_set('Asia/Kolkata');
if(isset($_POST['cancel'])){
  header('Location:index.php');
  return;
}
if(isset($_POST['user']) && isset($_POST['pass'])) {
  if(strlen($_POST['user'])<1 || strlen($_POST['pass'])<1 ) {
    $_SESSION['error']="User name and pass are required";
    header("Location: login.php");
    return;
  }
  $check = hash('md5', $salt.$_POST['pass']);

  $stmt = $pdo->prepare('SELECT user_id,name FROM users WHERE username = :un AND password = :pw');
  $stmt->execute(array( ':un' => $_POST['user'], ':pw' => $check));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if ( $row !== false ) {
    // Set the new timezone
    $_SESSION['date'] = date('d-m-y h:i:s');
    $_SESSION['name'] = $row['name'];
    $_SESSION['user_id'] = $row['user_id'];
    $stm = $pdo->prepare('SELECT users.username, users.name, acntdetails.Account_no, acntdetails.Currency_type, acntdetails.balance, acntdetails.Opening_date FROM users, acntdetails WHERE users.user_id = :uid AND acntdetails.user_id = users.user_id');
    $stm->execute(array(':uid' => $_SESSION['user_id']));
    $ro = $stm->fetch(PDO::FETCH_ASSOC);
    $_SESSION['acc']=$ro['Account_no'];
    $_SESSION['t'] = time();
    // Redirect the browser to index.php
    header("Location: index.php");
    return;
  }
  else {
    $_SESSION['error']="Incorrect Username or Password";
    header("Location: login.php");
    return;
  }
}

?>
<html>
<head>
  <title>Log In</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style media="screen">
body{
  background-image: url("../images/background.jpg");
background-repeat: no-repeat;
background-size: cover;
background-blend-mode: darken;
}

</style>
<body>

    <div class="w3-card-4 w3-round w3-margin w3-center w3-padding w3-light-grey  w3-topbar w3-border-green" style="width: 400px;height: 500px;position: absolute;top: 70px;left: 150px;">
    <form method="POST">
      <h3 class="w3-container w3-margin w3-padding">User Login</h3><br>
      <img class="w3-center" style="width: 20%;height: 20%;border-radius: 50%" src="../images/user.png"><br><br><br><br>
      <input type="text" name="user" placeholder="Username" class="w3-input w3-round-xxlarge"><br>
      <input type="password" name="pass" placeholder="Password" class="w3-input w3-round-xxlarge"><br>
      <button name="sub" class="w3-button w3-green w3-margin w3-padding" type="submit">Login</button>
      <input type="submit" class="w3-button w3-green w3-margin w3-padding" name="cancel" value="Cancel">
    </form>
    <?php
      if(isset($_SESSION['error'])) {
        echo '<p style = "color:red">'.$_SESSION['error']."</p>\n";
        unset($_SESSION['error']);
      }
      ?>
    </div>
</body>
</html>
