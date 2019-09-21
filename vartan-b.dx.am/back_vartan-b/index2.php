<?php require_once('files/secure/secure.php'); ?>

<!DOCTYPE HTML>
<html>
	<? if($_SESSION["admin_id"]){?>
	<head>
		<meta charset="UTF-8">
		<title>Administration Värtan B - <?=$_SESSION['username']?></title>
		<?include("general/head.php");?>
	</head>
	<body>
		<div id="logo">
			<a href="index2.php"><img src="../files/images/vartan.png" alt="Vartan logo" /></a>
		</div>
		<div id="nav_bar">
			<ul>
				<li><div id="player_list">Spelarlista</div></li>
				<?=(($_SESSION["lvl"] > 1) ? "<li><div id=add_player>Lägg till spelare</div></li>":"" )?>
				<li><div id="training_list">Evenemang</div></li>
				<?=(($_SESSION["lvl"] > 1) ? "<li><div id=add_event>Lägg till evenemang</div></li>":"" )?>
				<?=(($_SESSION["lvl"] == 3) ? "<li><div id=admin>Admin</div></li>":"" )?>
				<li><div id="logout">Logga ut</div></li>
			</ul>
		</div>
		<div id="container">
			<?php
				if($_GET['p']=="player_list" && $_SESSION["lvl"]){
					include("include/player_list.php");
				}else if($_GET['p']=="add_player" && $_SESSION["lvl"] > 1){
					include("include/add_player.php");
				}else if($_GET['p']=="stats_player" && $_SESSION["lvl"]){
					include("include/stats_player.php");
				}else if($_GET['p']=="edit_player" && $_SESSION["lvl"] > 1){
					include("include/edit_player.php");
				}else if($_GET['p']=="stats_player" && $_SESSION["lvl"] > 1){
					include("include/stats_player.php");
				}else if($_GET['p']=="add_event" && $_SESSION["lvl"] > 1){
					include("include/add_event.php");
				}else if($_GET['p']=="edit_event" && $_SESSION["lvl"] > 1){
					include("include/edit_event.php");
				}else if($_GET['p']=="check_player_attendance" && $_SESSION["lvl"]){
					include("include/check_player_attendance.php");
				}else if($_GET['p']=="training_list" && $_SESSION["lvl"]){
					include("include/training_list.php");
				}else if($_GET['p']=="admin" && $_SESSION["lvl"] == 3){
					include("include/admin.php");
				}else if($_GET['p']=="add_admin" && $_SESSION["lvl"] == 3){
					include("include/add_admin.php");
				}else if($_GET['p']=="logout" && $_SESSION["lvl"]){
					include("general/logout.php");
				
				}else{
					include("include/main.php");
				}
			?>
		</div>
	</body>
	<?}else{?>
	<body>
		<script>location = "index.php"</script>
	</body>
	<?}?>
</html>
