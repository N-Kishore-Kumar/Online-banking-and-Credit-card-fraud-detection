<?php
require_once "../pdo.php";
session_start();

unset($_SESSION['name']);
unset($_SESSION['user_id']);

if(isset($_POST['cancel'])) {
  header('Location:creditcard_index.php');
  return;
}
if(isset($_POST['user']) && isset($_POST['pass'])) {
  if(strlen($_POST['user'])<1 || strlen($_POST['pass'])<1 ) {
    $_SESSION['error']="User name and pass are required";
    header("Location: creditcard_login.php");
    return;
  }
  $stmt = $pdo->prepare('SELECT user_id,email FROM creditcardinfo
  WHERE username = :un AND password = :pw');
  $stmt->execute(array( ':un' => $_POST['user'], ':pw' => $_POST['pass']));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if ( $row !== false ) {
    $_SESSION['email'] = $row['email'];
    $_SESSION['user_id'] = $row['user_id'];
    // Redirect the browser to index.php
    header("Location: creditcard.php");
    return;
  }
  else {
    $_SESSION['error']="Incorrect Username or Password";
    header("Location: creditcard_login.php");
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
  background-image: url("../images/cred.jfif");
background-repeat: no-repeat;
background-size: cover;
background-blend-mode: darken;
}
</style>
<body>

  <div class="w3-card-4 w3-round w3-margin w3-center w3-padding w3-light-grey  w3-topbar w3-border-green" style="width: 400px;height: 500px;position: absolute;top: 70px;left:500px;">
  <form method="POST">
    <h3 class="w3-container w3-margin w3-padding">User Access</h3><br>
    <img class="w3-center" style="width: 20%;height: 20%;border-radius: 50%" src="../images/user.png"><br><br><br><br>
    <input type="text" name="user" placeholder="Username" id="usen" class="w3-input w3-round-xxlarge" required><br>
    <input type="password" name="pass" placeholder="Password" id="pw" class="w3-input w3-round-xxlarge" required><br>
    <input type="submit" class="btn btn-primary" value="Log In" >
    <input type="button" value="Cancel" class="btn btn-danger" id="fff" name="cancel">
  </form>
  <?php
    if(isset($_SESSION['error'])) {
      echo '<p style = "color:red">'.$_SESSION['error']."</p>\n";
      unset($_SESSION['error']);
    }
    ?>
  </div>

</body>
<script type="text/javascript">
  document.getElementById('fff').onclick=function(){
    window.location.href = "creditcard_index.php";};
</script>
</html>
