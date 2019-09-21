<?php session_start(); //var_dump($_POST);
	if($_POST["logout"]=((int)$_POST["logout"])){
		if($_SESSION['uid']){
			session_unset();
			if(session_destroy()==true)
				echo 1;
			else
				echo 2;
		}
	}
?>