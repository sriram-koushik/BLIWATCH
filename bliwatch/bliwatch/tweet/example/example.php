<?php
$consumerKey    = 'n4KfXNq9XiRJhm3g8yTc5w';
$consumerSecret = '0SltUbSiVKWQsgAbU8cuauzAX6MNt0DEffySDGRf3s';

//These are the ones randomly generated tokens saved from voicebot/callback.php
$oAuthToken     = '1098467196-GvWncbgD1EsK1V6CeUACPSzUoRW23OelNDc4gZd';
$oAuthSecret    = 'FSftT9Tx9PPBFrd2T9GoVNfE2N16WRmEpZykWId79Zw';


require_once('twitteroauth.php');

$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);

$tweet->post('statuses/update', array('status' => 'New this tweet  - from bot!'));

?>