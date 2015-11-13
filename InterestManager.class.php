<?php
class InterestManager {
	
	private $connection;
	
	function __construct($mysqli){
		
		$this->connection = $mysqli;
	}
	
	function addInterest($new_interest){
		
	
		//teen objekti, et saata tagasi kas errori (id, message) või successi (message) 
		$response = new StdClass();
		//kas selline email on juba olemas?
		$stmt = $this->connection->prepare("SELECT id FROM interests WHERE name = ?");
		$stmt->bind_param("s", $new_interest);
		$stmt->execute();
		
		//kas oli 1 rida andmeid
		if($stmt->fetch()){
			
			// saadan tagasi errori
			$error = new StdClass();
			$error->id = 0;
			$error->message = "Selline huviala on juba olemas!";
			
			//panen errori responsile külge
			$response->error = $error;
			
			// pärast returni enam koodi edasi ei vaadata funktsioonis
			return $response;
			
		}
	
		//*************************
		//******* OLULINE *********
		//*************************
		//panen eelmise käsu kinni
		$stmt->close();
	
		$stmt = $this->connection->prepare("INSERT INTO interests (name) VALUES (?)");
		$stmt->bind_param("s", $new_interest);
		
		if($stmt->execute()){
			// edukalt salvestas
			$success = new StdClass();
			$success->message = "Huviala edukalt salvestatud";
			
			$response->success = $success;
			
		}else{
			// midagi läks katki
			$error = new StdClass();
			$error->id =1;
			$error->message = "Midagi läks katki!";
			
			//panen errori responsile külge
			$response->error = $error;
		}
		
		$stmt->close();
		
		//saada tagasi vastuse, kas success või error
		return $response;
		
		
	}
	function createDropdown(){
			
			$html = '';
			
			$html .= '<select name="dropdownselect">';
				
				$stmt = $this->connection->prepare("SELECT name FROM interests");
				$stmt->bind_result($name);
				$stmt->execute();
				
				while($stmt->fetch()){
					$html .= '<option>'.$name.'</option>';
					
				}
				$stmt->close();
				//$html .= '<option value="1">Esmaspäev</option>';
				
				
			$html .= '</select>';
			
			return $html;
			
	}
	
} ?>