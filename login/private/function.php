<?php

function random_string($length)
{;
	$array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$text = "";

	$length = rand(4, $length);

	for ($i=0; $i <$length ; $i++) { 
		
		$random = rand(0, 61);

		$text .= $array[$random];

	}

return $text;
}

function esc($word)
{
	return addslashes($word);
}

function check_login($con)
{
	if (isset($_SESSION['url_add'])) 
	{
		$arr['url_add'] = $_SESSION['url_add'];
	
		$query = "select * from users where url_add = :url_add limit 1";
		$stm = $con->prepare($query);
		$check = $stm->execute($arr);

		if ($check) {

			$data = $stm->fetchALL(PDO::FETCH_OBJ);
			if(is_array($data) && count($data) > 0){

				return $data[0];
			}
				
		}
			
	}

	header("Location: login.php");
	die;
}