<?php
if($_POST['update']) {
	$name = utf8_decode(mysqli_real_escape_string($conn, $_POST['name']));
	$favorite_foot = (($_POST['favorite_foot']) ? $_POST['favorite_foot']:0 );
	$position = (($_POST['position'] <= 1 || !$_POST['position']) ? 1:"$_POST[position]");
	
	if($_POST['password']){
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$string = ", password='".md5($password)."'";
	}else{
		$string = " ";
	}
	
	$date =  $_POST['year_of_birth']."-".$_POST['month_of_birth']."-".$_POST['day_of_birth'];
		if(mysqli_query($conn, "update players set name='$name', favorite_foot='$favorite_foot', position='$position', age='$date' ".$string." where id='".(int)$_GET['player_id']."'")){?>
			<script>
				$(document).ready(function(){
					/*$("#msg").html("Jogador actualizado com sucesso.").fadeIn("slow");
					$("#msg").css({"color":"green"});*/
					ohSnap('Spelaren har blivit uppdaterad.', 'green');
				});
			</script>
		<?}else{?>
			<script>
				$(document).ready(function(){
					/*$("#msg").html("Jogador não foi actualizado.").fadeIn("slow");
					$("#msg").css({"color":"red"});*/
					ohSnap('Spelaren blev inte uppdaterad.', 'red');
				});
			</script>
		<?}
}?>
<script>
	$(document).ready(function(){
		$("#password").keyup(function(){
			var pass = $(this).val();
			
			if(pass.length == 5){
				$.post("ajax/functions.php",{chck_edit_pass: 1, password: pass},
					function(data){
						if(data == 1)
							$("#password").css({"background-color": "red","color": "white" });
						else if(data == 2)
							$("#password").css({"background-color": "green", "color": "white"});
						else
							alert('Error');
					}
				);
			}
		});
	});
</script>
<? if($_GET["p"] == "edit_player" && $_GET["player_id"] = ((int)$_GET["player_id"])){
	if(mysqli_num_rows($query = mysqli_query($conn, "select * from players where id = '".((int)$_GET["player_id"])."'"))){
		$fetch_query = mysqli_fetch_array($query, MYSQLI_ASSOC)?>
		<table class="halve-list text-left">
			<form method="POST">
				<tbody>
					<tr>
						<td>ID</td>
						<td><?=$fetch_query["id"]?></td>
					</tr>
					<tr>
						<td>Namn</td>
						<td><input type="text" name="name" value="<?=utf8_encode($fetch_query["name"])?>" class="input-big" /></td>
					</tr>
					<tr>
						<td>Spelfot</td>
						<td>
							<select name="favorite_foot">
								<option value="0" <?=((!$fetch_query["favorite_foot"]) ? 'selected="selected"':"")?>>--Välja--</option>
								<option value="1" <?=(($fetch_query["favorite_foot"] == 1) ? 'selected="selected"':"")?>>Höger fot</option>
								<option value="2" <?=(($fetch_query["favorite_foot"] == 2) ? 'selected="selected"':"")?>>Vänster fot</option>
								<option value="3" <?=(($fetch_query["favorite_foot"] == 3) ? 'selected="selected"':"")?>>Båda</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Position</td>
						<td>
							<select name="position">
								<?php
									if(mysqli_num_rows($query_player = mysqli_query($conn, "select * from positions")) > 0){
										while($result_query_player = mysqli_fetch_array($query_player, MYSQLI_ASSOC)){
											echo "<option value=".$result_query_player['id']." ".(($fetch_query['position'] == $result_query_player['id'])? 'selected="selected"':"").">".utf8_encode($result_query_player['position'])."</option>";
										}
									}
								?>
							</select>
						</td>
					</tr>
					<tr><?$age = explode("-",$fetch_query['age']);?>
						<td>Ålder</td>
						<td>
							<select name="day_of_birth">
								<?for($d = 1; $d <= 31; $d++) {
									echo "<option value=\"$d\" ".(($age["2"] == $d) ? 'selected="selected"':"")."> $d </option>";
								}?>
							</select>
							<select name="month_of_birth">
								<?for($m = 1; $m <= 12; $m++) {
									echo "<option value=\"$m\" ".(($age["1"] == $m) ? 'selected="selected"':"")."> $m </option>";
								}?>
							</select>
							<select name="year_of_birth">;
								<?for($y = date("Y"); $y >= 1970; $y--) {
									echo "<option value=\"$y\" ".(($age["0"] == $y) ? 'selected="selected"':"")."> $y </option>";
								}?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Lösenord</td>
						<td><input type="text" name="password" id="password" placeholder="leave blank for unchange" /></td>
					</tr>
					<tr>
						<td>Senast inloggad</td>
						<td><?=(($fetch_query["last_login"]) ? $fetch_query["last_login"] : "Nada")?></td>
					</tr>
					<tr>
						<td colspan="2" class="text-center"><input type="submit" name="update" /></td>
					</tr>
				</tbody>
			</form>
		</table>
		<!--<div id="msg" class="text-center"></div>-->
		<div id="ohsnap"></div>
	<?}
}else{
	echo "wrong page";
}
?>
