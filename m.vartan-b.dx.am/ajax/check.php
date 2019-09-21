<?php 
	session_start();
	require_once("../files/safe/config.php"); //var_dump($_POST);
	if($_POST['login'] = ((int)$_POST['login'])){
		$password = mysqli_real_escape_string($conn, $_POST['id_player']);
		if(mysqli_num_rows($query = mysqli_query($conn,"select * from players where password = '".md5($password)."'")) > 0){
			$obj = mysqli_fetch_array($query, MYSQLI_ASSOC);
			$_SESSION['uid'] = $obj['id'];
			$_SESSION['name'] = utf8_encode($obj['name']);
			$_SESSION['favorite_foot'] = $obj['favorite_foot'];
			$_SESSION['position'] = $obj['position'];
			
			if(mysqli_query($conn, "update players set last_login = '".$_POST['date']."' where password='".md5($password)."'")){
				echo 1;
			}else{
				echo 3;
			}
		}else{
			echo 2;
		}
	}else{
		echo 55;
	}
?>
