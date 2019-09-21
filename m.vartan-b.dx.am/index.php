<?php 
	session_start();
	require_once('files/safe/config.php'); ?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Vartän B lag anmäl system">
		<meta name="keywords" content="värtan-b, värtan ik, vik, v.i.k, värtan, vartan klub, värtan lag, fotboll, värtan lag B, lag B, värtan idrotts klub, fotboll värtan ik">
		<meta name="author" content="Alexandru Cheltuitor">
		<title>Värtan B<?=(($_SESSION['uid'])? " - ".$_SESSION['name']."":"");?></title>
		<?include("general/head.php");?>
		<meta name="viewport" content="width=device-width" />
	</head>
	<body>
		<div id="logo">
			<a href="index.php"><img src="files/images/vartan.png" alt="Värtan logo"/></a>
		</div>
		<?if(isset($_SESSION["uid"]) && $_SESSION["uid"] != "0"){?>
			<div id="nav_bar">
				<ul>
					<li><div id="main">Startsida</div></li>
					<li><div id="contact">Kontakt</div></li>
					<li><div id="logout">Logga ut</div></li>
				</ul>
			</div>
		<?}?>
		<div id="container">			
			<div id="content">
			<?if(isset($_SESSION["uid"]) && $_SESSION["uid"] != "0"){?>
				<div id="player_information" class="text-left">
					<table>
						<tbody>
							<tr>
								<td><b>Namn: </b><?=$_SESSION['name'];?></td>
							</tr>
						</tbody>
					</table>
					<div class="medium-separator align-center"></div> 
					<table>
						<tbody>
							<tr>
								<td><b>Spelfot: </b>
									<select id="favorite_foot"><?=$_SESSION['favorite_foot'];?><!--direito: 1; esquerdo: 2-->
										<option value="0" <?=((!$_SESSION['favorite_foot'])? 'selected="selected"':""); ?>>--Välja--</option>
										<option value="1" <?=(($_SESSION['favorite_foot']==1)? 'selected="selected"':""); ?>>Höger fot</option>
										<option value="2" <?=(($_SESSION['favorite_foot']==2)? 'selected="selected"':""); ?>>Vänster fot</option>
										<option value="3" <?=(($_SESSION['favorite_foot']==3)? 'selected="selected"':""); ?>>Båda</option>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="medium-separator align-center"></div> 
					<table>
						<tbody>
							<tr>
								<td><b>Position:</b>									
									<select id="position">
									<?php
										if(mysqli_num_rows($query_player = mysqli_query($conn, "select players.*, positions.*, positions.position as position_info, positions.id as positions_id from players, positions where players.id = '".((int)$_SESSION['uid'])."'")) > 0){
											while($result_query_player = mysqli_fetch_array($query_player, MYSQLI_ASSOC)){
												echo "<option value=".$result_query_player['positions_id']." ".(($_SESSION['position'] == $result_query_player['positions_id'])? 'selected="selected"':"").">".utf8_encode($result_query_player['position_info'])."</option>";
											}
										}else{
											echo 1;
										}
									?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="medium-separator align-center"></div> 
					<table>
						<tbody>
							<tr>
								<td><b>Ålder: </b>
									<?php
										$query_player = mysqli_query($conn, "select age from players where id = '".((int)$_SESSION['uid'])."'");
										$result_query_player = mysqli_fetch_array($query_player, MYSQLI_ASSOC); 
										$bday =	new DateTime($result_query_player['age']);
										//Differentiating both dates
										$age=$bday->diff(new DateTime);
										echo "$age->y";
									?>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="medium-separator align-center"></div> 
					<table>
						<tbody>
							<tr>
								<td><input class="btn" type="button" value="Uppdatera" id="update"></td>
							</tr>
						</tbody>
					</table>
					<br>
					<hr>
					<div id="msg" class="text-center"></div><br>
					<div class="attendance text-center">
						<input type="hidden" value="<?=$_SERVER['REQUEST_URI'];?>" id="url" />
						<?php
							if(mysqli_num_rows($query_attendance = mysqli_query($conn, "select *,(select description from dates where date = attendances.date) as description,  dayname(date) as day_name from attendances where player_id = '".$_SESSION['uid']."' and date > (curdate() - INTERVAL 1 DAY) ")) > 0){
								$result_query_attendance = mysqli_fetch_array($query_attendance, MYSQLI_ASSOC);
								switch($result_query_attendance['day_name']){
									case "Monday": $day_name = "Måndag";
													break;
									case "Tuesday": $day_name = "Tisdag";
													break;
									case "Wednesday": $day_name = "Onsdag";
													break;
									case "Thursday": $day_name = "Torsdag";
													break;
									case "Friday": $day_name = "Fredag";
													break;
									case "Saturday": $day_name = "Lördag";
													break;
									case "Sunday": $day_name = "Söndag";
													break;
								}
						
								if($result_query_attendance['attendance']==1)
									echo "Du har anmält dig till träningen den <br><b>$day_name, ".$result_query_attendance['date']."</b>.<br><b>Beskrivning: </b>".utf8_encode($result_query_attendance['description'])."<br><br>";
								else if($result_query_attendance['attendance']==2)
									echo "Jag kan inte närvara träningen den <b>$day_name, ".$result_query_attendance['date']."</b> eftersom att: <br>".utf8_encode($result_query_attendance['attendance_description'])."<br>";									
							}else{
								if(mysqli_num_rows($query_dates = mysqli_query($conn,"select *, dayname(date) as day_name from dates where date > (curdate() - INTERVAL 1 DAY) limit 1")) > 0){
																					/*SELECT * FROM dates WHERE date > (curdate() + INTERVAL 1 DAY) ORDER BY date limit 1 */
								$result_query_dates = mysqli_fetch_array($query_dates, MYSQLI_ASSOC);
									switch($result_query_dates['day_name']){
										case "Monday": $day_name = "Måndag";
														break;
										case "Tuesday": $day_name = "Tisdag";
														break;
										case "Wednesday": $day_name = "Onsdag";
														break;
										case "Thursday": $day_name = "Torsdag";
														break;
										case "Friday": $day_name = "Fredag";
														break;
										case "Saturday": $day_name = "Lördag";
														break;
										case "Sunday": $day_name = "Söndag";
														break;
									}
									echo "<b>Beskrivning: </b>".utf8_encode($result_query_dates['description'])."<br><b>Datum:</b> $day_name, ".$result_query_dates['date']."<input type=\"hidden\" value=".$result_query_dates['date']." id=\"date\" />";?>
									<div class="attendance_selection">
										Ja<input type="radio" name="attendance" value="1" />						
										Nej<input type="radio" name="attendance" value="2" />
										<div id="explanation" style="display: none;">
											<br>Berättigande:<br>
											<!--<textarea id="textarea_explanation"></textarea>-->
											<textarea id="textarea_explanation" rows="5" cols="35" style="resize: none;"></textarea>
										</div>
										<br><input type="button" id="confirm_attendance" value="Skicka" />
									</div>
								<?}else{?>
									<p>Det finns inga träningar</p>
								<?}?>
							
							<?}?>
					</div>
				</div>
				<div id="contacts" class="text-center">
					<p>För att kontakta oss:</p>
					<table style="border: none !important">
						<tr>
							<td>
								<a href="mailto:vartan.lag.b@gmail.com"><img src="files/images/email-icon.png" alt="e-mail icon"/></a>
								<img src="files/images/phone.png"/ alt="telefon"> 073 745 09 40
							</td>
						</tr>
					</table>
				</div>
			<?}else{?>
					<div id="login_form">
						<input type="password" id="password" /><br>
						<input class="btn" type="button" id="log" value="Login" />
						<div id="msg" style="display:none"></div>
						<input type="hidden" value="<?=$_SERVER['REQUEST_URI'];?>" id="url" />
					</div>
				<?}?>	
			</div>
		</div>
		<?include("general/footer.php");?>
	</body>
</html>
