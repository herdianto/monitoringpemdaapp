<?php 

	$data =  array(
		'id' => 2,
		'name' => "adit",
		'country' => "indo"
	);

	$id = $data['id'];
	$result[$id] = $data;

	var_dump($result[2]);
	var_dump($data['name']);



 ?>