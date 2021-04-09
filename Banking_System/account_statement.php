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
    <table border = "1" cellpadding = "10px" cellspacing = "10px" width=95%>
      <tr>
        <th> Acc. no </th>
        <th> Date </th>
        <th> Debit </th>
        <th> Credit </th>
        <th> Balance </th>
      </tr>
    <?php

      $stm=$pdo->prepare('SELECT * FROM acbal');
      $stm->execute();

      while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>";
        if($row['fro']==$_SESSION['acc']){
          echo htmlentities($row['ton']);
          echo "</td><td>";
          echo $row['dat'];
          echo "</td><td>";
          echo htmlentities($row['amt']);
          echo "</td><td>";
          echo "-</td><td>";
          echo htmlentities($row['balan']);
          echo "</td>";
          echo "</tr>";
        }
        else{
          echo $row['fro']."</td><td>";
          echo $row['dat']."</td><td>";
          echo "-</td><td>";
          echo $row['amt']."</td><td>";
          echo $row['balanto']."</td>";
          echo "</tr>";
        }
      }
    }




    ?>
</table>
    </div>
  </body>
</html>
