<?php 
		//$conn = mysqli_connect('fdb6.awardspace.net','1641794_teamb','TEMPPASSDB21');
		$conn = mysqli_connect('localhost','root','');
			if(!$conn){
				echo "Erro de ligação ao servidor!";
			}else{	
				$select_db = mysqli_select_db($conn,'1641794_teamb');
				if(!$select_db){
					echo "Erro na ligação da base de dados!";
				}
			}
?>
