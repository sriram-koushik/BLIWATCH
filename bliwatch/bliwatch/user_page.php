<?php session_start(); ?>
<! DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml">
<?php
include("functions.php");
include("connection.php");
$e=0;
if(isset($_SESSION['username'])){$suser=$_SESSION['username'];}
if(isset($_SESSION['password'])){$spass=$_SESSION['password'];}

if(!isset($_SESSION['username'])){
	header("Location: index.php");
}

if(isset($_POST['upload_image'])){
$id=$_POST['id'];
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
  }
else
  {
  $file_name = $_FILES["file"]["name"];
   $file_type = $_FILES["file"]["type"];
  $file_size = ($_FILES["file"]["size"] / 1024) . " kB";
    if(!is_dir("upload")){	mkdir("upload");}
	if(file_exists("upload/" . $_FILES["file"]["name"]))
      {   }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
	  $url = 'https://www.google.com/speech-api/v1/recognize?xjerr=1&client=chromium&lang=en-IN';
$audio = file_get_contents("upload/".$_FILES["file"]["name"]);
$ch = curl_init();
echo "ch :".$ch;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: audio/x-flac; rate=16000'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $audio);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$json = curl_exec($ch);
//echo "json :".$json."<br/>";
curl_close($ch);
$data = json_decode($json, true);
echo "<pre>";
$convtext=$data['hypotheses'][0]['utterance'];
//print_r($convtext);
echo "</pre>";
      setcookie("blitext", $convtext);
	//performing action
	$pieces = explode(" ", $convtext);
	$command=$pieces[0];
	$otherpart=$pieces[1];
	$usern="admin";
	  echo "Command - ".$command."Otherpart - ".$otherpart;
	  $consumerKey    = 'n4KfXNq9XiRJhm3g8yTc5w';
	  $consumerSecret = '0SltUbSiVKWQsgAbU8cuauzAX6MNt0DEffySDGRf3s';
	  require_once('tweet/twitteroauth/twitteroauth.php');
	  $query2="SELECT * FROM twitter_api where username='".$usern."'";
	  $res2=mysql_query($query2);
	  $oAuthToken=mysql_result($res2,0,'apikey');
	  $oAuthSecret=mysql_result($res2,0,'s_apikey');
	  echo $oAuthToken." ".$oAuthSecret;
	  $tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
	  if(strcmp($command,"tweet")==0||strcmp($command,"wat")==0||strcmp($command,"feet"))
		$tweet->post('statuses/update', array('status' => "'".$otherpart."'"));
	  
	 }
  }
  }
?>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bli Watch</title>
<link href="user_page.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.css" rel="stylesheet" />
	<link href="css/bootstrap.css" rel="stylesheet" />  
</head>
	<body id='body' onload='show_inbox()'>
<style>

</style>
<div id='edit_info'></div>

<div id='content_wrapper'>
<?php echo "<h2 style='margin-left:50px;' id='welcome'>Welcome {$suser} </h2><br/>"; ?>
<div id='theme'>CHANGE &nbsp THEME
<ul id='ul_theme'>
<li onclick="set_bg('image1.jpg')"><img src='images/image1.jpg' style='height:20px;width:50px;'/><span class='theme_name'>Elegant</span></li>
<li onclick="set_bg('image2.jpg')"><img src='images/image2.jpg' style='height:20px;width:50px;'/><span class='theme_name'>Cool</span></li>
<li onclick="set_bg('image3.jpg')"><img src='images/image3.jpg' style='height:20px;width:50px;'/><span class='theme_name'>Simple</span></li>
<li onclick="set_bg('image4.jpg')"><img src='images/image4.jpg' style='height:20px;width:50px;'/><span class='theme_name'>Waves</span></li>
</ul>
</div>
<ul id='tab'>
<li onclick='show_inbox()'><b>Inbox</b></li>
<li onclick='show_edit_info()'><b>Edit Info</b></li>
<li onclick='upload()'><b>Upload</b></li>
<li onclick='logout()'><b>Logout</b></li>
</ul>
<div id='tab_content_wrapper'><div id='tab_content'></div></div>
</div>
<script>
function set_bg(img){
document.getElementById('body').style.backgroundImage = 'url(images/'+img+')';
}
function show_edit_info(){
	var xmlhttp;
	if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();}
	else{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
	xmlhttp.onreadystatechange=function(){if (xmlhttp.readyState==4 && xmlhttp.status==200){
	document.getElementById("tab_content").innerHTML=xmlhttp.responseText;
	}}
	xmlhttp.open("GET","edit_info.php",true);
	xmlhttp.send();
}
function logout(){
	var xmlhttp;
	if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();}
	else{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
	xmlhttp.onreadystatechange=function(){if (xmlhttp.readyState==4 && xmlhttp.status==200){
	document.getElementById("tab_content").innerHTML=xmlhttp.responseText;
	window.location="index.php";
	}}
	xmlhttp.open("GET","actions.php?logout=1",true);
	xmlhttp.send();
}
function upload(){
	var xmlhttp;
	if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();}
	else{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
	xmlhttp.onreadystatechange=function(){if (xmlhttp.readyState==4 && xmlhttp.status==200){
	document.getElementById("tab_content").innerHTML=xmlhttp.responseText;
	}}
	xmlhttp.open("GET","upload.php",true);
	xmlhttp.send();
}
function up_name(name){
var xmlhttp;
if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();}
else{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
xmlhttp.onreadystatechange=function(){if (xmlhttp.readyState==4 && xmlhttp.status==200){
document.getElementById("save_changes").innerHTML=xmlhttp.responseText;
}}
xmlhttp.open("POST","actions.php?update=1",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("name="+name);
}
function up_email(email){
var xmlhttp;
if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();}
else{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
xmlhttp.onreadystatechange=function(){if (xmlhttp.readyState==4 && xmlhttp.status==200){
document.getElementById("save_changes").innerHTML=xmlhttp.responseText;
}}
xmlhttp.open("POST","actions.php?update=1",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("email="+email);
}
function up_phone(mobile){
var xmlhttp;
if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();}
else{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
xmlhttp.onreadystatechange=function(){if (xmlhttp.readyState==4 && xmlhttp.status==200){
document.getElementById("save_changes").innerHTML=xmlhttp.responseText;
}}
xmlhttp.open("POST","actions.php?update=1",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("mobile="+mobile);
}
function up_landline(landline){
var xmlhttp;
if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();}
else{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
xmlhttp.onreadystatechange=function(){if (xmlhttp.readyState==4 && xmlhttp.status==200){
document.getElementById("save_changes").innerHTML=xmlhttp.responseText;
}}
xmlhttp.open("POST","actions.php?update=1",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("landline="+landline);
}
function up_address(address){
var xmlhttp;
if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();}
else{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
xmlhttp.onreadystatechange=function(){if (xmlhttp.readyState==4 && xmlhttp.status==200){
document.getElementById("save_changes").innerHTML=xmlhttp.responseText;
}}
xmlhttp.open("POST","actions.php?update=1",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("address="+address);
}
function up_gender(gender){
var xmlhttp;
if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();}
else{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
xmlhttp.onreadystatechange=function(){if (xmlhttp.readyState==4 && xmlhttp.status==200){
document.getElementById("save_changes").innerHTML=xmlhttp.responseText;
}}
xmlhttp.open("POST","actions.php?update=1",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("gender="+gender);
}
function up_age(age){
var xmlhttp;
if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();}
else{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
xmlhttp.onreadystatechange=function(){if (xmlhttp.readyState==4 && xmlhttp.status==200){
document.getElementById("save_changes").innerHTML=xmlhttp.responseText;
}}
xmlhttp.open("POST","actions.php?update=1",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("age="+age);
}
</script>
</body>
</html>