<?php require_once("../files/safe/config.php"); //var_dump($_POST);
if($_POST['confirm_attendance'] = ((int)$_POST['confirm_attendance'])){
	
	$date = $_POST['date'];
	$id_player = ((int)$_POST['id_player']);
	$option = ((int)$_POST['option']);
	$explanation = mysqli_real_escape_string($conn, $_POST['explanation']);
	$explanation_dec = utf8_decode($explanation);
	
	if($option == 2 && !$explanation_dec){
		echo 55;
	}else{
		if(mysqli_num_rows(mysqli_query($conn, "select * from attendances where date = '".$date."' and player_id = '".$id_player."'")) > 0){
			echo 56;
		}else{
			if(mysqli_query($conn, "insert into attendances (`date`, `player_id`, `attendance`, `attendance_description`) values ('$date','$id_player','$option','$explanation_dec')") > 0){
				echo 1;
			}else{
				echo 2;
			}
		}
	}
		
}else if($_POST['update'] = ((int)$_POST['update'])){
	$id_player = ((int)$_POST['id_player']);
	$favorite_foot = ((!$_POST['favorite_foot']) ? 0:$_POST['favorite_foot'] );
	$position = (($_POST['position'] <= 1 || !$_POST['position']) ? 1:"$_POST[position]");
	
	if(mysqli_query($conn, "update players set favorite_foot = '$favorite_foot', position = '$position' where id = '$id_player'") > 0){
		
		unset($_SESSION['favorite_foot']);
		unset($_SESSION['position']);
		$_SESSION['favorite_foot'] = $favorite_foot;
		$_SESSION['position'] = $position;
		
		echo 1;
	}else{
		echo 2;
	}
}else{
	echo 56;
}
?>
