<?php require_once("../files/secure/secure.php"); //var_dump($_POST);
if($_POST["delete_player"] = ((int)$_POST["delete_player"])){
	if(mysqli_query($conn, "update players set deleted = 1 where id = ".(int)$_POST["player_id"]."")){
		echo 1;
	}else{
		echo 2;
	}
}else if($_POST["delete_event"] = ((int)$_POST["delete_event"])){
	if(mysqli_num_rows(mysqli_query($conn, "select count(*) from attendances where date = '".$_POST["date"]."'")) > 0){
		if(mysqli_query($conn, "delete from attendances where date = '".$_POST["date"]."'")){
			if(mysqli_query($conn, "delete from dates where date = '".$_POST["date"]."'"))
				echo 1;
		}else{
			echo 2;
		}
	}else{
		if(mysqli_query($conn, "delete from dates where date = '".$_POST["date"]."'"))
			echo 1;
		else
			echo 3;
	}
}
