<?php 
require_once('lib/TwitterAPIExchange.php');


echo "<h2>Simple Twitter API Test</h2>";

$settings = array(
		'oauth_access_token' 		=>	"228025597-YUcY0ZzKu6UKRvHbCWmNVkWJX6KA2q6iXMYJm2aX",
		'oauth_access_token_secret'	=>	"jt1Nm1VDPrsiMF6hewuteeQPnDnrBUrzzpsCd2IgyIdiW",
		'consumer_key'				=>	"NSY2Z4FZFVxfj79oDurQ4dzuu",
		'consumer_secret'			=>	"iU76267myutQgMjFqVdBL2N8VGCynDVIXwVUWVkUxrwZtqrpMd"
	);

$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

$requestMethod = "GET";

$getfield = '?screen_name=pemkotbandung&count=1';

$twitter = new TwitterAPIExchange($settings);
$contenttwitter = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();


$decodejson = json_decode($contenttwitter);

echo $decodejson[0]->{'created_at'};



?>