<?php
require_once "../pdo.php";
session_start();
?>
<html>
<head>
	<title> Welcome </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="//code.jquery.com/jquery.min.js"></script>
</head>
<style media="screen">
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
	padding-bottom: 200px;
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
th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
tr:hover{
	background-color: #ddd;
}
.slidecontainer {
  width: 70%;
}
.slider {
  -webkit-appearance: none;
  width: 100%;
  height: 25px;
  background: #d3d3d3;
	border-radius: 20px;
  outline: none;
  opacity: 0.9;
  transition: opacity .2s;
}
.slider:hover {
  opacity: 1;
}
.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 35px;
  height: 35px;
  border-radius: 25px;
  background: #4CAF50;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  background: #4CAF50;
  cursor: pointer;
}
</style>
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
		<div class="home">
  		<a href="../Creditcard_Fraud_Detection/creditcard_index.php">Fraud detection</a>
  	</div>
		<div class="home"  style="background-color:red">
      <a href="logout.php" style="color:black">Log-out</a>
    </div>
  </div>
    <div class="split right">
      <h3 style="text-align:center;">Apply For the Credit Card</h3>
      <p style="text-align:center;">Our credit card is the best</p>
      <form  class="w3-padding w3-margin" onsubmit="return reg()" method="post">
        <div class="container" style="margin-bottom:50px;">
        <div class="w3-container w3-left w3-card-4 w3-padding w3-margin w3-light-grey" style="width:900px;height:450px;">
        <div class="container">
        <label for="">First Name<p style="color:red;display:inline;">*</p></label>
        <input style="margin-left:15px;" type="text" name="no" placeholder="First" required>
        <label for="" style="margin-left:50px;">Last Name<p style="color:red;display:inline;">*</p></label><input style="margin-left:15px;" type="text" name="" placeholder="Last" required>
        <br>
        <label style="margin-top:20px;" for="">Age<p style="color:red;display:inline;">*</p></label>
        <input style="margin-left:62px;" type="number" name="na" placeholder="age" required>
        <br>
        <label for="">Type of credit card<p style="color:red;display:inline;">*</p></label>
        <select style="margin-left:50px;width:200px;margin-top:20px;" class="" name="Select" value="select">
          <option value="" selected>Platinum</option>
          <option value="">Diamond</option>
          <option value="">Gold</option>
          <option value="">Silver</option>
        </select>
        <br>
        <label for="" style="margin-top:20px;">Company Name<p style="color:red;display:inline;">*</p></label>
        <input  type="text" style="margin-left:70px;" name="bra" placeholder="Company" required>
        <br>
        <label for="" style="margin-top:20px;">Net Income<p style="color:red;display:inline;">*</p></label>
        <div class="slidecontainer">
          <input id="ra"type="number" name="ran" placeholder="Net Income" required>
          <br>
          <input style="margin-top:10px;"type="range" min="0" max="1000000" value="0" step="1000" class="slider" id="myRange">
          <br>
        </div>
        <br>
        <input class="btn btn-primary" type="submit"  name="but" value="Apply">
        <br>
				<p id="den"></p>
        </div>
        </div>
        <br>
          </div>
      </form>
    </div>
</body>
<script>
var slider = document.getElementById("myRange");
var output = document.getElementById("ra");
output.innerHTML = slider.value;
slider.oninput = function() {
  output.value = this.value;
}
function reg(){
	document.getElementById('den').innerHTML="Your application has been taken";
	document.getElementById('den').style.color="red";
	return false;
}
<?php
}
?>
</script>
</html>
