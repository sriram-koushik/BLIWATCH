<?php
$consumerKey    = 'n4KfXNq9XiRJhm3g8yTc5w';
$consumerSecret = '0SltUbSiVKWQsgAbU8cuauzAX6MNt0DEffySDGRf3s';
$oAuthToken     = 'ePmZN3wTQVPGIU2B927ZLhWbqGTGsr6YkBb0eF8jEJ4';
$oAuthSecret    = 'ME174yarYCGDusG8GfKPuQa7d9ZImvxS8ftZS3e7P1U';
require_once('twitteroauth/twitteroauth.php');

$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);

$tweet->post('statuses/update', array('status' => 'Neglect this tweet  - from bot!'));

?>