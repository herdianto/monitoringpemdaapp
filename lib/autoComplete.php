<?php 
include($_SERVER['DOCUMENT_ROOT']."/monitoringpemdaapp/connection.php");

$sql =  "SELECT pemda.id_pemda, pemda.nama_pemda AS text FROM pemda WHERE pemda.nama_pemda LIKE '%".($_GET['q'])."%' ";
$result = $conn->query($sql);

if (isset($result)) {
	
	while ($row=$result->fetch_assoc()) {
             $answer[] = array('id' => $row['id_pemda'], 'text' => $row['text']);
               
             }; 
} else {
			$answer[] = array('id' => "0" , 'text'=>"No Result Found..." );
}
	
	
	 echo json_encode($answer);
	
	






?>