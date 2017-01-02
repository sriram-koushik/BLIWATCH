<?php
session_start();
?>
<! DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml">
<?php
include("functions.php");
include("connection.php");
$e=0;
if(isset($_POST['register'])){
header("Location: register_online.php");
die;
}
if(isset($_SESSION['username'])){header("Location: user_page.php");}
if(isset($_POST['login'])){
$username=mysql_prep($_POST['username']);
$password=mysql_prep($_POST['password']);
$sql="SELECT * FROM user_details WHERE username='{$username}' && password='{$password}'";
$res = mysql_query($sql,$db);
$c=mysql_num_rows($res);
if($c==1)
{
$_SESSION['username']=$username;
$_SESSION['password']=$password;
if($_COOKIE["blicookie"]==""||$_COOKIE["blicookie"]==$_SESSION['username'])
					{setcookie("blicookie",$_SESSION['username'] );}
echo "<script>window.location='user_page.php';</script>";
}else
{$e=1;}
}
?>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bli Watch</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
    

    <div class="container">

      <form class="form-signin" method="post">
        <h2 class="form-signin-heading"><?php if($e==1){echo "<p>Invalid User...!<p>";} else{echo "Please sign in";} ?></h2>
        <input type="text" name="username" class="input-block-level" placeholder="Username" />
        <input type="password" name="password" class="input-block-level" placeholder="Password" />
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-large btn-primary" type="submit" name='login'>Sign In</button>
		<button class="btn btn-large btn-primary" type="submit" name="register">Register</button>
	  </form>

    </div>
</body>
</html>