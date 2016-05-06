<?php 
function getGooglePagerank($url) {
		
		$query="http://toolbarqueries.google.com/tbr?client=navclient-auto&ch=".self::CheckHash(self::HashURL($url)). "&features=Rank&q=info:".$url."&num=100&filter=0";
		try{
			$data= file_get_contents($query);
			$pos = strpos($data, "Rank_");
			if($pos === false){} else{
				$pagerank = substr($data, $pos + 9);
				return $pagerank;
			}
		}catch(Exception $e)
		{
			return 0;	
		}
 
 
	}

	$a = getGooglePagerank('http://portal.bandung.go.id');
	var_dump($a);

?>