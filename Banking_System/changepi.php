<?php
require_once "../pdo.php";
session_start();
?>
<html>
  <head>
    <title></title>
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
      padding-bottom: 250px;
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
  <?php
  $stmt=$pdo->prepare('select cardn,pin from acntdetails where Account_no=:un');
  $stmt->execute(array(':un'=>$_SESSION['acc']));
  $ro = $stmt->fetch(PDO::FETCH_ASSOC);
  $_SESSION['card']=$ro['cardn'];
  $_SESSION['pin']=$ro['pin'];
   ?>

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
    	<div class="home" style="background-color:red">
    		<a href="logout.php" style="color:black">Log-out</a>
    	</div>
    </div>
	<div class="split right" style="margin-bottom:20px;">
		<div class="w3-container w3-left w3-card-4 w3-padding w3-margin w3-light-grey" style="width:400px;height:550px;margin-bottom:20px;">
			<h2>Change Pin</h2><br>
				<form method="post" onsubmit="return rig()" action="<?=$_SERVER['PHP_SELF'];?>">
				<div style="margin-bottom:50px;">
          <label for="card">Card Number</label>
          <input type="text" name="card" value="1111222233334444" pattern="[0-9]{16}" class="w3-input w3-round-xxlarge" id="card" required>
          <label for="pin">Existing Pin</label>
          <input type="password" name="pin" placeholder="Existing Pin" class="w3-input w3-round-xxlarge" pattern="[0-9]{4}" id="pin" required>
          <label for="newpin">New Pin (4 digit number)</label>
          <input type="password" name="newpin" placeholder="New Pin" class="w3-input w3-round-xxlarge" pattern="[0-9]{4}" id="newpin" required>
          <label for="retypenewpin">Retype New Pin (4 digit number)</label>
          <input type="password" name="retypenewpin" placeholder="Retype New Pin" class="w3-input w3-round-xxlarge" pattern="[0-9]{4}" id="retypenewpin" required>
          <p id="test"></p>
          <p id="tes"></p>
          <input type="submit" class="w3-button w3-green w3-margin w3-padding" name="but" value="Change">
        </div>
      </form>
		</div>
    </div>

    <script type="text/javascript">
    function rig(){
         document.getElementById('test').innerHTML="change";
         var car=document.getElementById('card').value;
         var pi=document.getElementById('pin').value;
         var fcar="<?php echo $_SESSION['card']; ?>";
         var fpi="<?php echo $_SESSION['pin']; ?>";
         var rpi=document.getElementById('retypenewpin').value;
         var npi=document.getElementById('newpin').value;
         if(rpi!=npi){
           document.getElementById('test').innerHTML="The new pin and confirm pin are not matched"+rpi+npi;
           return false;
         }
         else if(car==fcar && pi==fpi){
           <?php
           $stm=$pdo->prepare('update acntdetails set pin=:ui where Account_no=:un');
           $stm->execute(array(':un'=>$_SESSION['acc'],':ui'=>$_POST['newpin']));
           ?>
          document.getElementById('test').innerHTML="Success!! Your pin is changed";
          document.getElementById('test').style.color='red';
          <?php sleep(3); ?>;
          return true;
         }
         else if(car!=fcar) {
           document.getElementById('test').innerHTML="Wrong Card Number"+fcar;
           return false;
         }
         else if (pi!=fpi) {
           document.getElementById('test').innerHTML="Wrong Pin number";
           return false;
         }
         else{
           document.getElementById('test').innerHTML="Wrong details";
           return false;
         }
      }
      <?php

    }?>
    </script>
  </body>
</html>
