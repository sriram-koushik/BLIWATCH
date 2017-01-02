<?php
/**
 * @file
 * Take the user when they return from Twitter. Get access tokens.
 * Verify credentials and redirect to based on response from Twitter.
 */

/* Start session and load lib */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

include("connection.php");

/* If the oauth_token is old redirect to the connect page. */
if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) 
{
  $_SESSION['oauth_status'] = 'oldtoken';
  header('Location: ./clearsessions.php');
}

/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

/* Request access tokens from twitter */
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

/* Save the access tokens. Normally these would be saved in a database for future use. */
$_SESSION['access_token'] = $access_token;

/* Remove no longer needed request tokens */
unset($_SESSION['oauth_token']);
unset($_SESSION['oauth_token_secret']);

/* If HTTP response is 200 continue otherwise send to connect page to retry */
if (200 == $connection->http_code) {
  /* The user has been verified and the access tokens can be saved for future use */
  $_SESSION['status'] = 'verified';
  /*
  /
  /
  /
  CODE FOR SUCCESSFUL RETURN
  /
  /
  /
  */
  //Two lines for echoing the token and secret token below $access_token['oauth_token']."','".$access_token['oauth_token_secret']."'
  
  //$usern=$_COOKIE["blicookie"];
 // echo $usern;
  $usern="admin";
  $query1="INSERT INTO twitter_api values('".$usern."','".$access_token['oauth_token']."','".$access_token['oauth_token_secret']."');";
	mysql_query($query1);
$connection->post('statuses/update', array('status' => 'first tweet - BLIWATCH!'));
	echo "Thank you for authorizing the app! <a href='http://www.psgtecheclub.com/bliwatch/user_page.php'>Take me back</a>";
  //header('Location: ./index.php');
  
} else {
  /* Save HTTP status for error dialog on connnect page.*/
  header('Location: ./clearsessions.php');
}
