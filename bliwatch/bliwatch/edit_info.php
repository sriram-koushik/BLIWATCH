<! DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
include("functions.php");
include("connection.php");

?>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bli Watch</title>
</head>
<style>
input{width:200px;height:100px;}
#register_form_wrapper{
color:white;
width:99%;
height:100%;
text-transform:uppercase;
padding:0px;
}
#register_form{
color:white;
width:99%;
-webkit-border-radius: 10px;-moz-border-radius: 10px;border-top-radius:10px;
height:100%;
}
td{color:black;}
</style>
<body>
<?php
$username=$_SESSION['username'];
$sql=mysql_query("SELECT * FROM user_details WHERE username='{$username}'");

while($row = mysql_fetch_array($sql)){
	$username=$row['username'];
	$key=$row['key'];
	$name=$row['name'];
	$age=$row['age'];
	$gender=$row['gender'];
	$address=$row['address'];
	$email=$row['email'];
	$mobile=$row['mobile'];
	$landline=$row['landline'];
}
?>
	<div id='register_form_wrapper'>
		<div id='register_form'>
		<table style='text-transform:uppercase;font-size:18px;'>
		<tr><td>Username</td><td>:</td><td style='text-transform:lowercase;'><?php echo $username;?></td><td>Dev ID :<?php echo $key; ?></td></tr>
		<tr><td>Name</td><td>:</td><td style='width:350px;'><input onkeyup='up_name(this.value)' type='text' id='name' maxlength='50' <?php echo"value='{$name}'"; ?> /></td>
		<td>E Mail</td><td>:</td><td><input type='text' id='email' onkeyup='up_email(this.value)' style='width:200px;' maxlength='50' <?php echo"value='{$email}'"; ?>/></td></tr>
		<tr><td>Gender</td><td>:</td><td>
		<input type='radio' id='gender' name='gender' value='male' onkeyup='up_gender(this.value)'>Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type='radio' id='gender' name='gender' value='female' onkeyup='up_gender(this.value)'>Female
		
		</td><td>Age :</td><td>:</td><td><input type='text' maxlength='2' name='age' <?php echo"value='{$age}'"; ?> onkeyup='up_age(this.value)'></td></tr>
		<tr><td>Phone No</td><td>:</td><td><input type='text' onkeyup='up_phone(this.value)' id='phone' maxlength='10' <?php echo"value='{$mobile}'"; ?>/></td>
		<td>Landline No</td><td>:</td><td><input type='text' onkeyup='up_landline(this.value)' id='landline' maxlength='11' <?php echo"value='{$landline}'"; ?>/></td>
		</tr>
		<tr><td>Address</td><td>:</td><td><textarea id='address' onkeyup='up_address(this.value)' rows='4' cols='35'><?php echo $address; ?></textarea></td></tr>
			<tr><td><a href="tweet/index.php">Click here to authorize the twitter app!</a></td></tr>
	</table>
	</table>
		<span id='save_changes'></span>
		</div>
	</div>
</body>

</html>