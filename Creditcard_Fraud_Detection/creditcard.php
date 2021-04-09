<?php
session_start();
require_once "SimpleXLS.php";
require_once "../pdo.php";
?>

<html>
<head>
	<title>Fraud Detection</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<script src="//code.jquery.com/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

</head>
<style media="screen">
body {
	background-size: cover;
	background-position: center;
}

body,
html {
	width: 100%;
	height: 100%;
	margin-top: 0px;
	font-family: "Lato";

}
h1 {
font-weight: 700;
font-size: 5em;
}
.footer{
padding-top:5%;
text-align: center;
background-color: lightgreen;
padding-bottom: 10px;

}
hr {
	width: 400px;
	border-top: 1px solid #f8f8f8;
	border-bottom: 1px solid rgba(0,0,0,0.2);
}
button{
	align: center;
}
.header{
	padding-top: 20px;
	background-color: lightgreen;
	width: 100%;
	height: 200px;
	text-align: center;
	color: white;
}
.sin{
	opacity: 0.7;
	text-align: center;
}
</style>
<body >

<?php
  if(! isset($_SESSION['user_id'])){ ?>
    <p> ACCESS DENIED </p><br>
    <p>Please <a href="../Creditcard_Fraud_Detection/creditcard_login.php"> Click here </a> to login </p>
    <?php
  }

else {
	unset($_SESSION['msg_file']);
	unset($_SESSION['id_f']);
	unset($_SESSION['msg']);
	unset($_SESSION['id']);
	if(file_exists('Resume/test_case.xls'))
		unlink('Resume/test_case.xls');?>
	<div class="header">
		<a href="account_setting.php" style="float:right;margin-right:20px;" title="Account Setting"><img src="../images/setting.png" alt="Account Setting" width="30"></a><br><br><Br>
		<a class="btn btn-danger" href="creditcard_index.php" style="float:right;margin-right:1px;">Logout</a>
		<h1>The Credit Card Fraud Detector</h1>
		<h3>Check out if your card is valid or invalid</h3>

	</div>
 <div class="container">
 	<div class="row">
		<div class="sin">
			<img style="margin-left:10px;" src="../images/up.png" alt="">
			<br>
			<p>You can upload files</p>
			<br>

			<img style="margin-left:10px;" src="../images/type.png" width = "100" height="75" alt="">
			<br>
			<p>Or You can type text</p>
			<br>

			<img style="margin-left:7px;" src="../images/ma1.png" width = "100" alt="">
			<br>
			<p>We will detect any fraud in your credit card</p>
			<br>
		</div>
 		<div class="col-lg-12">

 		</div>

 	</div>
 </div>


 <div class="footer">
	<form name="form" method="post">
<div class="form-group">
<label for="exampletext" >Enter Card ID<i class="fa fa-upload" style="font-size:24px"></i></label>
<input type="text" name="text" id="exampletext">
<input type="submit" class="btn btn-primary" name="submit" onclick = "getfocus()" value="Test">
</div>
</form>
<br><p><strong>(OR)</strong></P><br>
	<form name="form" method="post" enctype="multipart/form-data">
		<div class="form-group">
<label for="exampleInputFile" >File input<i class="fa fa-upload" style="font-size:24px"></i></label>
<input type="file" style="margin-left:660px;" name="my_file_res" id="exampleInputFile"><br>
<input type="submit" class="btn btn-primary" name="submit_res" onclick = "getfocus()" value="Upload">
</div>
</form>
<?php
$arr = array();
if ( $xls = SimpleXLS::parse('list_scale.xls') ) {
 $arr = $xls->rows();
} else {
 echo SimpleXLS::parseError();
}
echo '<pre>';

//Text Input

if(isset($_POST['submit'])){
 $id = $_POST['text'];
 $_SESSION['id'] = $id;
 for($i=0;$i<count($arr);$i++){
	for($j=1;$j<count($arr[$i]);$j++){
		if($arr[$i][$j] == $id){
			$_SESSION['prob'] = $arr[$i][2];
			break 2;
		}
	}
 }
 if(isset($_SESSION['prob'])){
	$thank = "Thank you for using, you will receive a mail shortly in the registered Mail ID";
	$prob = $_SESSION['prob'];
	if($prob>=0 && $prob<0.25){
		$_SESSION['msg']= "Your card is safe";
	}
	else if($prob>=0.25 && $prob<0.50){
		$_SESSION['msg']= "Check your card transactions and make sure you have done those transactions";
	}
	else if($prob>=0.50 && $prob<0.75){
		$_SESSION['msg']= "Your card has seen some unusual transactions, enquire with your bank";
	}
	else if($prob>=0.75 && $prob<=1){
		$_SESSION['msg']= "Block your card immediately and contact your bank";
	}
	unset($_SESSION['prob']);
	echo '<p style="color:green;font-size:24">'.$thank.'</p>';
 }
 else{
	echo '<p style="font-size:24px;color:red">Card ID Not Found. Please Contact your bank</p>';
 }

}
?>


<?php
//File Uplaod

if(isset($_POST['submit_res'])) {

if (($_FILES['my_file_res']['name']!="")){


// Where the file is going to be stored for resume
 $target_dir = "Resume/";
 $uploadOK = 1;
 $file = $_FILES['my_file_res']['name'];
 $path = pathinfo($file);
 $path['filename'] = 'test_case';
 $filename = $path['filename'];
 $ext = $path['extension'];
 $temp_name = $_FILES['my_file_res']['tmp_name'];
 $path_filename_ext = $target_dir.$filename.".".$ext;
 $allowed_image_extension = array(
        "xls"
    );

// Check if file already exists

 if (file_exists($path_filename_ext)) {
 echo "<p style='font-size:24px;color:red'>Sorry, Resume file already exists.</p>";
 $uploadOK = 0;
 }
 if (! in_array($ext, $allowed_image_extension)) {
   echo "<p style='font-size:24px;color:red'>Upload valiid files. Only XLS files are allowed.</p>";
   $uploadOK = 0;
 }
 if (($_FILES["my_file_res"]["size"] > 1000000)) {
   echo "<p style='font-size:24px;color:red'>File size should not exceed 1MB.</p>";
   $uploadOK = 0;
 }
 if($uploadOK == 0) {
   echo "<p style='font-size:24px;color:red'>Couldn't Upload the File</p>";
 }
 else {
   if(move_uploaded_file($temp_name,$path_filename_ext))
			$_SESSION['ms'] = "Done";
 }
}

else {
	echo "<p style='font-size:24px;color:red'>Choose to Upload the File</p>";
  header('Location:creditcard.php');
  return;
}
}

if(isset($_SESSION['ms'])){
	unset($_SESSION['ms']);
	$tes = array();
	if ( $xls = SimpleXLS::parse('Resume/test_case.xls') ) {
		$tes = $xls->rows();
	} else {
		echo SimpleXLS::parseError();
	}
	$id = $tes[1][0];
	$_SESSION['id_f'] = $id;
  for($i=0;$i<count($arr);$i++){
 	for($j=1;$j<count($arr[$i]);$j++){
 		if($arr[$i][$j] == $id){
 			$_SESSION['prob'] = $arr[$i][2];
 			break 2;
 		}
 	}
  }


	if(isset($_SESSION['prob'])){
 	$thank = "Thank you for uploading file, you will receive a mail shortly in the registered Mail ID";
 	$prob = $_SESSION['prob'];
 	if($prob>=0 && $prob<0.25){
 		$_SESSION['msg_file']= "Your card is safe";
		//echo $_SESSION['msg_file'];
 	}
 	else if($prob>=0.25 && $prob<0.50){
 		$_SESSION['msg_file']= "Check your card transactions and make sure you have done those transactions";
 	}
 	else if($prob>=0.50 && $prob<0.75){
 		$_SESSION['msg_file']= "Your card has seen some unusual transactions, enquire with your bank";
 	}
 	else if($prob>=0.75 && $prob<=1){
 		$_SESSION['msg_file']= "Block your card immediately and contact your bank";
 	}
 	unset($_SESSION['prob']);
 	echo '<p style="color:green;font-size:24">'.$thank.'</p>';
  }
  else{
 	echo '<p style="font-size:24px;color:red">Card ID Not Found. Please Contact your bank</p>';
  }

?>
 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<?php }
}
?>
<?php
if(isset($_SESSION['msg'])){
	$stmt = $pdo->prepare('SELECT email FROM creditcardinfo WHERE user_id=:uid');
	$stmt->execute(array(':uid' => $_SESSION['user_id']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$mailid = htmlentities($row['email']);
	$to=$mailid;
	$sub="Credit Card Fraud Status";
	$msg="Credit Card ID: ". $_SESSION['id']."\n\n";
	$msg.="Card Status : ".$_SESSION['msg']."\n";
	$m=mail($to,$sub,$msg);
	if($m){
		unset($_SESSION['msg']);
		unset($_SESSION['id']);
	}
	else {
		echo "Couldn't send the mail due to network issues, please try again later $to $msg";
	}

}

if(isset($_SESSION['msg_file'])){
	$stmt = $pdo->prepare('SELECT email FROM creditcardinfo WHERE user_id=:uid');
	$stmt->execute(array(':uid' => $_SESSION['user_id']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$mailid = htmlentities($row['email']);
	$to=$mailid;

	$sub="Credit Card Fraud Status";
	$msg="Credit Card ID: ". $_SESSION['id_f']."\n\n";
	$msg.="Card Status : ".$_SESSION['msg_file']."\n";
	$m=mail($to,$sub,$msg);

	if($m){
		unlink('Resume/test_case.xls');
		unset($_SESSION['msg_file']);
		unset($_SESSION['id_f']);
	}
	else{
		echo "Couldn't send the mail due to network issues, please try again later $to $msg";
	}
}


?>
</div>

</body>
</html>
