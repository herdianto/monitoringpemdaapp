<?php
	function curl_helper($url) {
	  $ch = curl_init();
	  $timeout = 5;
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	  curl_setopt($ch, CURLOPT_URL, $url);
	  $data = curl_exec($ch);
	  curl_close($ch);
	  return json_decode($data);
	}
	// Facebook Page: take the last post from here.
	$page_ID = '{115590758456160}';
	// Hardcode the App Acces token obtained in point 3. (Server Side Please.)
	$access_token = '{995255017222647|_7RpISQ5JE_N6j3x8XUpgCdWSb8}';
	$posts = curl_helper('https://graph.facebook.com/'.$page_ID.'/posts?access_token='.$access_token);
	$latest_post =  $posts->data[0];
	list($pageID, $postID) = preg_split('/_/', $latest_post->id);
	$post_url = 'https://www.facebook.com/'.$pageID.'/posts'.'/'.$postID;
	$text = '<a href="'.$post_url.'">'.$latest_post->message.'</a>';
	echo $text;
?>