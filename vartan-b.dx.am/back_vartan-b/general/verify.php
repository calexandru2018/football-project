<?php include('../files/secure/secure.php'); 
	if($_POST["username"] && $_POST["password"] && $_POST["date"]){
		$username = utf8_decode(mysqli_real_escape_string($conn, $_POST["username"]));
		$password = utf8_decode(mysqli_real_escape_string($conn, $_POST["password"]));
		$date = $_POST["date"];
		
		if(mysqli_num_rows($query = mysqli_query($conn, "select id, username, password, permission_lvl from administration where username='".$username."' and password='".md5($password)."' and active limit 1")) > 0) {
			$fetch = mysqli_fetch_array($query, MYSQLI_ASSOC);

			$_SESSION['admin_id'] = $fetch['id'];
			$_SESSION['username'] = utf8_encode($fetch['username']);
			$_SESSION['lvl'] = $fetch['permission_lvl'];
			
			if(mysqli_query($conn, "update administration set last_login = '".$date."' where id='".((int)$fetch['id'])."'"))
				header("Location: ../index2.php");
			else
				header("Location: ../index.php?e=3");				
		}else{
			header("Location: ../index.php?e=2");
		}
	}else{
		header("Location: ../index.php?e=1");
	}
?>
