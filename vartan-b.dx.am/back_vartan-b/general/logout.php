<?php
	if($_SESSION['admin_id']){
		session_unset();
		if(session_destroy()==true)
			echo "<script>window.location.reload()</script>";
	}
?>