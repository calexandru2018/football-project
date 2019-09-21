<?php 
	session_start();
	$useragent=$_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
		// header('Location: http://m.vartan-b.dx.am');
		header('Location: m/');
	}
require_once('files/safe/config.php');?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Vartän B lag anmäl system">
		<meta name="keywords" content="värtan-b, värtan ik, vik, v.i.k, värtan, vartan klub, värtan lag, fotboll, värtan lag B, lag B, värtan idrotts klub, fotboll värtan ik">
		<meta name="author" content="Alexandru Cheltuitor">
		<title>Värtan B<?=(isset($_SESSION["uid"])? " - ".$_SESSION['name']."":"");?></title>
		<?include("general/head.php");?>
	</head>
	<body>
		<div id="logo">
			<a href="index.php"><img class="align-center" src="files/images/vartan.png" alt="Värtan logo"/></a>
		</div>
		<?if(isset($_SESSION["uid"]) && $_SESSION["uid"] != "0"){?>
			<div id="nav_bar" class="align-center text-center">
				<ul>
					<li><div id="main">Startsida</div></li>
					<li><div id="contact">Kontakt</div></li>
					<li><div id="logout">Logga ut</div></li>
				</ul>
			</div>
		<?}?>
		<div id="container" class="align-center">			
			<div id="content">
			<?if(isset($_SESSION["uid"]) && $_SESSION["uid"] != "0"){?>
				<div id="player_information">
					<table id="information" class="align-center text-center">
						<th>Namn</th>
						<th>Spelfot</th>
						<th>Position</th>
						<th>Ålder</th>
						<tbody>
							<tr>
								<td><?=$_SESSION['name'];?></td>
								<td>
									<select id="favorite_foot"><?=$_SESSION['favorite_foot'];?><!--direito: 1; esquerdo: 2-->
										<option value="0" <?=((!$_SESSION['favorite_foot'])? 'selected="selected"':""); ?>>--Välja--</option>
										<option value="1" <?=(($_SESSION['favorite_foot']==1)? 'selected="selected"':""); ?>>Höger fot</option>
										<option value="2" <?=(($_SESSION['favorite_foot']==2)? 'selected="selected"':""); ?>>Vänster fot</option>
										<option value="3" <?=(($_SESSION['favorite_foot']==3)? 'selected="selected"':""); ?>>Båda</option>
									</select>
								</td>	
								<td>
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
								<td><?php
										$query_player = mysqli_query($conn, "select age from players where id = '".((int)$_SESSION['uid'])."'");
										$result_query_player = mysqli_fetch_array($query_player, MYSQLI_ASSOC); 
										$bday =	new DateTime($result_query_player['age']);
										//Differentiating both dates
										$age=$bday->diff(new DateTime);
										echo "$age->y";
									?>
								</td>
							</tr>
							<tr>
								<td colspan="4"></td>
							</tr>
							<tr>
								<td  rowspan="3" colspan="4"><input class="btn" type="button" value="Uppdatera" id="update"></td>
							</tr>
						</tbody>
					</table>
					<br/>
					<hr>
					<div id="msg" class="text-center"></div><br>
					<div class="attendance text-center align-center">
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
								if(mysqli_num_rows($query_dates = mysqli_query($conn,"select *, dayname(date) as day_name from dates where date > (curdate() - INTERVAL 1 DAY) limit 1"))){
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
											<textarea id="textarea_explanation"></textarea>
											<br>
										</div>
										<br><input type="button" id="confirm_attendance" value="Skicka" />
									</div>
								<?}else{?>
									<p></p>Det finns inga träningar</p>
								<?}?>
							
							<?}?>
					</div>
				</div>
				<div id="contacts">
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
