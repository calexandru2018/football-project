<?php require_once("../files/secure/secure.php"); //var_dump($_POST);
if($_POST["chck_pass"] = ((int)$_POST["chck_pass"]) && $_POST["password"]){
	
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	
	if(mysqli_num_rows(mysqli_query($conn, "select password from players where password = '".md5($password)."'")) > 0){
		echo 1;
	}else{
		echo 2;
	}
	
}else if($_POST["chck_edit_pass"] = ((int)$_POST["chck_edit_pass"]) && $_POST["password"]){
	
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	
	if(mysqli_num_rows(mysqli_query($conn, "select password from players where password = '".md5($password)."'")) > 0){
		echo 1;
	}else{
		echo 2;
	}
}else if($_POST["attendance_change"] = ((int)$_POST["attendance_change"]) && $_POST["type_of_change"] = ((int)$_POST["type_of_change"])){
	if(mysqli_num_rows(mysqli_query($conn, "select * from attendances where player_id = '".((int)$_POST["playerid"])."' and date = '".$_POST["date"]."'")) > 0){		
		/*if($_POST["type_of_change"] == 1){
			if(mysqli_num_rows(mysqli_query($conn, "update attendances set attendance = '".$_POST["type_of_change"]."'")) > 0){
				
			}
		}else if($_POST["type_of_change"] == 2){
			
		}*/
		//".(($_POST["type_of_change"] == 2) ?  ", attendance_description = $explanation":", attendance_description = ''")."
		$explanation = utf8_decode($_POST["explanation"]);
		if(mysqli_query($conn, "update attendances set attendance = '".$_POST["type_of_change"]."'".(($_POST["type_of_change"] == 2) ?  ", attendance_description = '$explanation'":", attendance_description = ''")." where player_id = '".((int)$_POST["playerid"])."' and date = '".$_POST["date"]."'")){
			echo 1;
		}else{
			echo 2;
		}
	}else{
		echo 3;
	}
}
