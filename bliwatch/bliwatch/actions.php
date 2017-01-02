<?php
session_start();
include("functions.php");
include("connection.php");
if(isset($_SESSION['username'])){$username=$_SESSION['username'];}

if(isset($_GET['logout'])){
unset($_SESSION['username']);
unset($_SESSION['password']);
setcookie ("blicookie", "", time() - 13000);
}



if(isset($_GET['val_user'])){
$username=$_POST['username'];
$sql=mysql_query("SELECT * FROM user_details WHERE username='{$username}'");
$c=0;
$c=mysql_num_rows($sql);
if($c!=0){
echo "<span class='error'>Username already exists</span>";
}
}

if(isset($_GET['update'])){
if(isset($_POST['name'])){
	$name=mysql_prep($_POST['name']);
	$sql=mysql_query("UPDATE user_details SET name='{$name}' WHERE username='{$username}'");
}
if(isset($_POST['mobile'])){
	$mobile=mysql_prep($_POST['mobile']);
	$sql=mysql_query("UPDATE user_details SET mobile='{$mobile}' WHERE username='{$username}'");
}
if(isset($_POST['landline'])){
	$landline=mysql_prep($_POST['landline']);
	$sql=mysql_query("UPDATE user_details SET landline='{$landline}' WHERE username='{$username}'");
}
if(isset($_POST['email'])){
	$email=mysql_prep($_POST['email']);
	$sql=mysql_query("UPDATE user_details SET email='{$email}' WHERE username='{$username}'");
}
if(isset($_POST['address'])){
	$address=mysql_prep($_POST['address']);
	$sql=mysql_query("UPDATE user_details SET address='{$address}' WHERE username='{$username}'");
}
if(isset($_POST['gender'])){
	$gender=mysql_prep($_POST['gender']);
	$sql=mysql_query("UPDATE user_details SET gender='{$gender}' WHERE username='{$username}'");
}
if(isset($_POST['age'])){
	$age=mysql_prep($_POST['age']);
	$sql=mysql_query("UPDATE user_details SET age='{$age}' WHERE username='{$username}'");
}
}
?>