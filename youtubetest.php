<?php

$channel_id = 'DJSnakeVEVO';
$api_key = 'AIzaSyDcwGJUrrQyyLdfjebrVp832AoNdjY8nnw';

$json_url="https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=".$channel_id."&key=".$api_key;
$json = file_get_contents($json_url);
$listFromYouTube=json_decode($json);
$id = $listFromYouTube->items[0]->snippet->resourceId->videoId;

echo $id; // Outputs the video ID.

?>