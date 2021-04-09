<?php
require_once "../pdo.php";
session_start();
$salt='XyZzy12*_';
if(isset($_POST['changepass'])){
  if(isset($_POST['user'])&&isset($_POST['pass'])&&isset($_POST['newpass'])&&isset($_POST['retypenewpass'])){
    if(strlen($_POST['user'])<1 || strlen($_POST['pass'])<1 || strlen($_POST['newpass'])<1 || strlen($_POST['retypenewpass'])<1 ) {
      $_SESSION['error']="All Fields are required";
      header("Location: changepa.php");
      return;
    }
    $check = hash('md5', $salt.$_POST['pass']);
    $stmt = $pdo->prepare('SELECT user_id,name FROM users WHERE username = :un AND password = :pw');
    $stmt->execute(array( ':un' => $_POST['user'], ':pw' => $check));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ( $row !== false ) {
      $code = $_POST['newpass'];
      $newpw =  $md5 = hash('md5', $salt.$code);
      $stm = $pdo->prepare('UPDATE users SET password = :pw WHERE username = :un');
      $stm->execute(array( ':un' => $_POST['user'], ':pw' => $newpw));
      $_SESSION['msg'] = "Password Updated";
  }
  else{
    $_SESSION['error']="Incorrect Username or Password";
    header("Location: changepa.php");
    return;
  }

}
}
?>
<html>
  <head>
    <title></title>
    <script type="text/javascript">
    function validateform(){
    var myInput = document.getElementById("newpassword");
    var mypw = document.getElementById("retypenewpassword")
    var lowerCaseLetters = /[a-z]/g;
    var upperCaseLetters = /[A-Z]/g;
    var numbers = /[0-9]/g;
    var speacialchars = /["@","*","#","!","&"]/g
    //var usechar = /^[a-z0-9_-]{3,16}/g
    //if(! myInput.value.match(usechar)) {
  //    alert('Username should only contain alphabets, numbers and @ sign');
  //  }
    if(myInput.value.length < 8) {
      alert('Password must be above 8 characters');
      myInput.focus();
      return false;
    }
    else if(! myInput.value.match(lowerCaseLetters)) {
      alert('Use lowerCase Letters');
      myInput.focus();
      return false
    }
    else if(! myInput.value.match(upperCaseLetters)) {
      alert('Use upperCase Letters');
      myInput.focus();
      return false
    }
    else if(! myInput.value.match(numbers)) {
      alert('Use numbers');
      myInput.focus();
      return false
    }
    else if(! myInput.value.match(speacialchars)) {
      alert('Use atleast one special character');
      myInput.focus();
      return false
    }
    else if(myInput.value != mypw.value) {
      alert("Password and confirm passwords should match");
      myInput.focus();
      return false
    }
}
  </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
    input{
      margin-bottom: 20px;
      display: inline-grid;
    }
    .split {
    height: 100%;
    margin-top: 200px;
    position: fixed;
    z-index: 1;
    top: 0;
    overflow-x: hidden;
    padding-top: 20px;
    background-color: #cce7ff;
    }
    .left {
      left: 0;
    	width: 20%;
    	background-color: #ccffeb;
    	background-size: 300px;
    }

    .right {
    	padding-left: 50px;
      right: 0;
    	width: 80%;
      padding-bottom: 50px;
    }
    .home{
    	height: 50px;
    	width: 250px;
    	padding-top: 15px;
    	padding-left: 15px;
    }
    .home:hover{
    	background-color: #f0f8ff;
    	height: 50px;
    	width: 250px;
    }
    .col1{
    	background-color:#1a1aff;
    	height: 70px;
    	margin-bottom: 5px;
    	padding-left: 40px;
    	padding-top: 5px;
    	font-family: "Comic Sans MS", cursive, sans-serif;
    }
    .col2{
    	background-color:#ff8c1a;
    	margin-top: 0px;
    	height: 45px;
    }
    .colo{
    	margin-top: 0px;
    	height: 160px;
    	margin-left: 150px;
    }
    tr:nth-child(even){
    	background-color: #f2f2f2;
    }
    th{
    	height:10px;
    	border-radius:400px;
    }
  </style>
  </head>
  <body>
    <?php
    if(! isset($_SESSION['user_id'])) { ?>
      <h1 style="height: 150px" class="w3-margin-top w3-padding-32 w3-blue w3-lobster w3-center w3-container">
        KVR Bank
        <br>
        <div class="w3-margin-top w3-bottom-middle w3-large w3-bar w3-black">
          <a href="login.php" class="w3-bar-item w3-button w3-mobile">Log In</a>
          <a href="../Creditcard_Fraud_Detection/creditcard_index.php" class="w3-bar-item w3-button w3-mobile">Credit Card Fraud Detector</a>
        </div>
      </h1>
    <?php
  }
    else {
      function auto_abort($field){
    	  $t = time();
    	  $t0 = $_SESSION[$field];
    	  $diff = $t - $t0;
    	  if ($diff > 600 || !isset($t0))
    	  {
    	      return true;
    	  }
    	  else
    	  {
    	      $_SESSION[$field] = time();
    	  }
    	}
    	if(auto_abort("t"))
    	{
    			$_SESSION['err'] = "Process Aborted due to inactivity";
    			unset($_SESSION['user_time']);
    			header("Location:logout.php");
    			return;
    	}
    	echo '<img style="float:left;display:inline-block;height:150px;width:150px;border:1px solid black;margin-top:0px;" src="../images/banklogo.png" alt="KVR" title="KVR">';
    	echo "<h1 style='float:right;display:inline-block;margin-top:0px;margin-bottom:0px;'> Welcome ".$_SESSION['name'].",</h1><br>";
    	echo "<br><p style='text-align:right;padding-right:0px;margin-top:10px;margin-bottom:0px;'>".$_SESSION['date']."</p>";
    ?>
    <div class="colo">
    	<div class="col1">
    		<h2 style="color:yellow;">KVR Bank</h2>
    	</div>
    	<div class="col2">

    	</div>
    </div>
    <div class="split left">
      <div class="home">
    		<a href="index.php">Home</a>
    	</div>
    	<div class="home">
    		<a href="acntdetails.php">Account Details</a>
    	</div>
    	<div class="home">
    		<a href="transaction.php">Fund Transfer</a>
    	</div>
    	<div class="home">
    		<a href="changepi.php">Change Pin</a>
    	</div>
    	<div class="home">
    		<a href="crca.php">Apply Credit card</a>
    	</div>
    	<div class="home">
    		<a href="account_statement.php">Account Statements</a>
    	</div>
    	<div class="home">
    		<a href="changepa.php">Change Password</a>
    	</div>
      <div class="home"  style="background-color:red">
        <a href="logout.php" style="color:black">Log-out</a>
      </div>
    </div>
	<div class="split right">
		<div class="w3-container w3-left w3-card-4 w3-padding w3-margin w3-light-grey" style="width:400px;height:550px;">
			<h2>Change Password</h2><br>
				<form method="post" onsubmit="return validateform()">
					<label for="user">Username</label>
					<input type="text" name="user" placeholder="Username" class="w3-input w3-round-xxlarge" id="user" required>
					<label for="password">Existing Password</label>
					<input type="password" name="pass" placeholder="Existing Password" class="w3-input w3-round-xxlarge" id="password" required>
					<label for="newpassword">New Password</label>
					<input type="password" name="newpass" placeholder="New Password" class="w3-input w3-round-xxlarge" id="newpassword" required>
					<label for="retypenewpassword">Retype New Password</label>
					<input type="password" name="retypenewpass" placeholder="Retype New Password" class="w3-input w3-round-xxlarge" id="retypenewpassword" required>
					<button name="changepass" class="w3-button w3-green w3-margin w3-padding" type="submit">Change Password</button>
				</form>
        <?php
        if(isset($_SESSION['msg'])){
          echo '<span style = "color:green">'.$_SESSION['msg']."</span>\n";
          unset($_SESSION['msg']);
        }
        else if(isset($_SESSION['error'])){
          echo '<span style = "color:red">'.$_SESSION['error']."</span>\n";
          unset($_SESSION['error']);
        }
      }
        ?>
		</div>
  </div>
</body>
</html>
