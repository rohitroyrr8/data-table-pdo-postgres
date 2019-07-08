<?php
	class user {
		public function insertLead($user, $db)
		{
			if(empty($user['email']) || empty($user['name']) || empty($user['mobile']) || empty($user['state']) || empty($user['city']) || empty($user['model']) ) {
				return 4;
			}
			if(!$this->validateEmail($user['email'])){
	 			return 5;
	 		} else {

	 			$sql = "INSERT INTO hondacarindia (name, email, mobile, city, state, model, lead_id, lead_code, lead_msg, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	 			$statement = $db->prepare($sql);
	 			if(is_object($statement)){
	 				
	 				$url = "http://13.234.170.243/addLeads.php?name=".str_replace(' ', '%20', $user['name'])."&email=".$user['email']."&mobile=".$user['mobile']."&city=".str_replace(' ', '%20', $user['city'])."&make=Honda&state=".str_replace(' ', '%20', $user['state'])."&model=".str_replace(' ', '%20', $user['model'])."&sub_source=Apoxy%20Media&source=303&device_plateform=&dealer_name=&utm_campaign=".str_replace(' ', '%20', $user['utm_camapign'])."&utm_medium=".str_replace(' ', '%20', $user['utm_medium'])."&utm_term=".str_replace(' ', '%20', $user['utm_term'])."&utm_content=".str_replace(' ', '%20', $user['utm_content'])."&gclid=".str_replace(' ', '%20', $user['glid'])."&webpage=apoxymedia.com&utm_source=".str_replace(' ', '%20', $user['utm_source'])."";

 					$ch = curl_init($url);
				    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
				    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
				    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				    $json = curl_exec($ch);
				    if(curl_error($ch)) { 
				    echo 'error:' . curl_error($ch);
				    };
				    curl_close($ch);
					$data = json_decode($json,true);

					/*echo $data['status'];*/

	 				//$date = date('d M, Y', strtotime('now'));
	 				$date = date('Y-m-d');
	 				
	 				$statement->bindParam(1, $user['name'], PDO::PARAM_STR);
	 				$statement->bindParam(2, $user['email'], PDO::PARAM_STR);
	 				$statement->bindParam(3, $user['mobile'], PDO::PARAM_STR);
	 				$statement->bindParam(4, $user['city'], PDO::PARAM_STR);
	 				$statement->bindParam(5, $user['state'], PDO::PARAM_STR);
	 				$statement->bindParam(6, $user['model'], PDO::PARAM_STR);
	 				$statement->bindParam(7, $data['lead_id'], PDO::PARAM_STR);
	 				$statement->bindParam(8, $data['type'], PDO::PARAM_STR);
	 				$statement->bindParam(9, $data['message'], PDO::PARAM_STR);
	 				$statement->bindParam(10, $date, PDO::PARAM_STR);

	 				$statement->execute();
	 				if($statement->rowCount()){
	 					

	 					return $db->lastInsertId();
	 				}
	 			}
	 			return 1;
	 		}
		}
		public function validateEmail($email)
		{
			if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email)) {
				return false;
			}
			return true;
		}
	}

	$user = new user();
?>