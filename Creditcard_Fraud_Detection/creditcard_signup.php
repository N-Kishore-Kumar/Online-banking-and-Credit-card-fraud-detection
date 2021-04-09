<?php
require_once "../pdo.php";
session_start();
  if(isset($_POST['cancel'])) {
    header("Location: creditcard_index.php");
    return;
  }
  $name='';
  $email='';
  $phno='';
  $dob='';
  $username='';
  if(isset($_POST['nam']) && isset($_POST['email']) && isset($_POST['phno']) && isset($_POST['dob']) && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['cnpw'])) {
    $pas=$_POST['pass'];
    $name = htmlentities($_POST['nam']);
    $email = htmlentities($_POST['email']);
    $phno = htmlentities($_POST['phno']);
    $dob = htmlentities($_POST['dob']);
    $username = htmlentities($_POST['user']);
      $s = $pdo->prepare("INSERT INTO creditcardinfo (name,username,password,email,phone_no,dob) VALUES (?,?,?,?,?,?)");
      $s->bindparam(1,$name);
      $s->bindparam(2,$username);
      $s->bindparam(3,$pas);
      $s->bindparam(4,$email);
      $s->bindparam(5,$phno);
      $s->bindparam(6,$dob);
      $s->execute();
      $_SESSION['success'] = "Account Created";
      //sleep(1);
      header('Location:creditcard_login.php');
  }
?>
<html>
<head>
  <title> Sign up </title>
  <script type="text/javascript">
  function validateform(){
  var myInput = document.getElementById("pw");
  var mypw = document.getElementById("cnpw")
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
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
  .dd{
    margin:0px 50px 0px 50px;
    border-bottom: 200px solid white;
    padding-left:200px;
    padding-right:200px;
    padding-top:100px;
    height: 2000px;
    animation-name: ed;
    animation-duration: 5s;
    animation-iteration-count: infinite;
    animation-direction: alternate;
    animation-timing-function:ease-in-out;
  }
  @keyframes ed {
    from{border: 150px solid lightgreen;}
    to{border: 150px solid blue;}
  }
  #ree{
    font-size:35px;
  }
  #in{
    display: none;
    margin-left: 100px;
    position: relative;
    height: 500px;
  }

</style>
</head>
<body>
  <?php
    if(isset($_SESSION['success'])) {
      echo '<p style = "color:green">'.$_SESSION['success']."</p>\n";
      unset($_SESSION['success']);
    }
    ?>
    <div class="dd">
      <div class="card text-center">
      <div style="border-top:2px solid red;" class="card-header">
        <h3>Sign Up</h3>
      </div>
        <div class="card-body">
  <form method="post" method="post" onsubmit="return validateform()" name="myform">
  <p>  <label for="nam">Name</label>
    <br>
    <input type="text" name="nam" id="nam" size=40 value="<?php echo $name;?>" required></p>
  <p>  <label for="email">Email</label>
    <br>
    <input type="email" name="email" id="email" size=40 value="<?php echo $email;?>" title="Please check your email address" required ></p>
  <p>  <label for="phno">Phone Number</label>
    <br>
    <input type="text" name="phno" id="phno" pattern="[7-9]{1}[0-9]{9}" title="Phone number with 7-9 and remaing 9 digit with 0-9" value="<?php echo $phno;?>" required></p>
  <p>  <label for="dob">Date of Birth</label>
    <br>
    <input type="date" name="dob" id="dob" value="<?php echo $dob;?>" required></p>
  <p>  <label for="usen">User name</label>
<br>
    <input type="text" name="user" id="usen" value="<?php echo $username;?>" required></p>
  <p>  <label for="pw">Password</label>
<br>
    <input type="password" name="pass" id="pw" required>
    <p style="font-size:10px;"> (Password Rule: Password must be minimum 8 character with atleast One upper and lower alphabet, one digit and one special character [@ ! & * #]) </p>
  <p>  <label for="cnpw">Confirm Password</label>
<br>
    <input type="password" name="cnpw" id="cnpw" required></p>
    <input class="btn btn-success" style="margin-bottom:10px;" type="submit" value="Log In">
    <input type="reset" style="margin-bottom:10px;margin-left:5px;" class="btn btn-primary" value="Reset">
    <br>
    <a class="btn btn-danger"  href="creditcard_index.php">Back</a>
  </form>

  </div>
  </div>
</div>

</body>
</html>
