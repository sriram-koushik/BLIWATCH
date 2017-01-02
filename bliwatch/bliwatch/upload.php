<?php
session_start();
include("connection.php");
$username=$_SESSION['username'];
echo "<h4 style='margin-left:50px;'>Upload a file : </h4><br/>";
?>

<form method='post' enctype='multipart/form-data'>
	<input type='file' name='file' /><br/>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ID : <input type='text' name='id' /> <br/><br/><br/>
	<input type='submit' name='upload_image' value='Upload' />
	</form>