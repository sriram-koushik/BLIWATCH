<! DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
include("functions.php");
include("connection.php");
if(isset($_SESSION['username'])){header("Location: user_page.php");}
$e=0;

if(isset($_POST['register'])){
	$name=mysql_prep($_POST['name']);
	$username=mysql_prep($_POST['username']);
	$password=mysql_prep($_POST['password']);
	$re_password=mysql_prep($_POST['re_password']);
	if(($username!="")&&($name!="")&&($password!="")&&($re_password!="")){
		$sql=mysql_query("SELECT * FROM user_details WHERE username='{$username}'");
		$c=0;
		$c=mysql_num_rows($sql);
		if($c!=0){$msg="<span class='error'>Username already exists</span>";}
		else{
			$sql = "INSERT INTO user_details (`username`,`password`,`name`)
					VALUES('{$username}','{$password}','{$name}')";
			$res = mysql_query($sql,$db);
			if($res){
				$_SESSION['username']=$username;
				$_SESSION['password']=$password;
				echo "<script>window.location='user_page.php';</script>";
			}
		}
	}
	else{
		$e=1;
		$msg = "<span class='error'>Fields should not be empty</span>";
	}
}
?>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bli Watch</title>
<link href="register.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
    
</head>
<style>
.success{color:green; font-weigth:bold;}
.error{color:red; font-weigth:bold;}
.warning{color:#986458; font-weight:bold;}
</style>
<script type='text/javascript'>

function validate_username(username){
	var username = document.getElementById('username').value;
	var error=0;
		var xmlhttp;
if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();}
else{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
xmlhttp.onreadystatechange=function(){if (xmlhttp.readyState==4 && xmlhttp.status==200){
document.getElementById("er_username").innerHTML=xmlhttp.responseText;
}}
xmlhttp.open("POST","actions.php?val_user=1",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("username="+username);
}
function validate_password(password){
if(password!=""){
		if((password%1==0)||(password.search(/[^A-Za-z\s]/)== -1)||(password.length<=6)){
			document.getElementById('er_pass').innerHTML="<span class='error'>Weak password</span>";
		//	er_password=1;
			}
		else if(password.length<=10){
			document.getElementById('er_pass').innerHTML="<span class='warning'>Medium password</span>";
	//		er_password=0;
		}
		else{
		//	er_password=0;
			document.getElementById('er_pass').innerHTML="<span class='success'>Strong password</span>";
		}
	}
}
function validate_re_password(re_password){
	if(re_password!=""){
	var password=document.getElementById("password").value;
	
		if(re_password!=password){
			document.getElementById('er_re_password').innerHTML="Both password's do not match";
	//		error=1;
		}
		else{
			document.getElementById('er_re_password').innerHTML="*";
		}
		
	}
}
</script>
<style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 600px;
        height: 350px;
		width:700px;
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

<body>
	<div id='register_form_wrapper'>
		<div id='register_form'>
		Sign Up...!<hr/>
		<div class="form-signin">
        <form method='post'>
		<h2 class="form-signin-heading" style='font-style:italic;font-size:20px;'><?php if($e==1) echo $msg; ?></h2>
		<table>
        <tr><td>Username :</td><td><input type="text" id="username" name='username' class="span4" placeholder="Username" onchange='validate_username(this.value)' /></td><td id='er_username'>*</td></tr>
        <tr><td>Password :</td><td><input type="password" id="password" name='password' class="span4" placeholder="Password" onchange='validate_password(this.value)' /></td><td id='er_pass'>*</td></tr>
        <tr><td>Confirm Password :</td><td><input type="password" id="re_password" name='re_password' class="span4" placeholder="Confirm Password" onchange='validate_re_password(this.value)' /></td><td id='er_re_password'>*</td></tr>
        <tr><td>Name :</td><td><input type="text" id="name" name='name' class="span4" placeholder="Name" /></td><td id='er_name'>*</td></tr>
		</table>
		<br/>
		<div style='float:right;margin-right:170px;'>
        <button class="btn btn-large btn-primary" type="submit" name='register' onclick='signup()' >Sign Up</button>
		<button class="btn btn-large btn-primary" type="reset" name="reset">Reset</button>
	  </div>
	  </form>
	  <div id='submit_sign'></div>
	  </div>
	</div>
	</div>
</body>

</html>