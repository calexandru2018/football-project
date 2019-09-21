<?php
	if($_POST['insert']) {
		if($_POST['name'] && ($_POST['position']==((int)$_POST['position'])) && $_POST['password']) {
		
		$name = utf8_decode(mysqli_real_escape_string($conn, $_POST['name']));
		$favorite_foot = (($_POST['favorite_foot']) ? $_POST['favorite_foot']:"0" );
		$position = (($_POST['position'] <= 1 || !$_POST['position']) ? 1:"$_POST[position]");
		
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$date =  $_POST['year_of_birth']."-".$_POST['month_of_birth']."-".$_POST['day_of_birth'];
		
		$string = "insert into players (`name`,`favorite_foot`,`position`,`password`,`age`,`deleted`) values ('$name','$favorite_foot','$position','".md5($password)."','$date', 0)";
		
			if(mysqli_query($conn, $string)){?>
				<script>
					$(document).ready(function(){
						/*$("#msg").html("Jogador inserido com sucesso.").fadeIn("slow");
						$("#msg").css({"color":"green"});*/
						ohSnap('Spelare tillagd.', 'green');
					});
				</script>
			<?}else{//echo $string;?>
				<script>
					$(document).ready(function(){
						/*$("#msg").html("Jogador não foi inserido.").fadeIn("slow");
						$("#msg").css({"color":"red"});*/
						ohSnap('Spelare blev ej tillagd.', 'red');
					});
				</script>
			<?}
		}else{?>
			<script>
				$(document).ready(function(){
					/*$("#msg").html("Dados não foram completados para inserir.").fadeIn("slow");
					$("#msg").css({"color":"red"});*/
					ohSnap('Det saknas information.', 'yellow');
				});
			</script>
		<?}
	}
?>
<script>
	$(document).ready(function(){
		$("#password").keyup(function(){
			var pass = $(this).val();
			
			if(pass.length == 5){
				$.post("ajax/functions.php",{chck_pass: 1, password: pass},
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
<table class="halve-list text-left">
	<form method="POST">
		<tbody>
			<tr>
				<td>Namn</td>
				<td><input type="text" name="name" /></td>
			</tr>
			<tr>
				<td>Spelfot</td>
				<td>
					<select name="favorite_foot">
						<option value="0">--Välja--</option>
						<option value="1">Höger fot</option>
						<option value="2">Vänster fot</option>
						<option value="3">Båda</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Position</td>
				<td>
					<select name="position">
						<option value="0">--Välja--</option>
							<?php
								if(mysqli_num_rows($query_positions = mysqli_query($conn, "select * from positions")) > 0){
									while($result_query_positions = mysqli_fetch_array($query_positions, MYSQLI_ASSOC)){
										echo "<option value=".$result_query_positions['id']." >".utf8_encode($result_query_positions['position'])."</option>";
									}
								}
							?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Lösenord</td>
				<td><input type="text" name="password" maxlength="5" id="password" /></td>
			</tr>
			<tr>
				<td>Födelsedatum</td>
				<td>
					<select name="day_of_birth">
						<?while($day <= 30) {
							$day++;
							echo "<option value=\"$day\">$day</option>";
						}?>
					</select>
					<select name="month_of_birth">
						<?while($month <= 11) {
							$month++;
							echo "<option value=\"$month\">$month</option>";
						}?>
					</select>
					<select name="year_of_birth">
						<?for($year = date("Y"); $year >= 1970; $year--){
							echo "<option value=\"$year\">$year</option>";
						}?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="text-center"><input type="submit" name="insert" /></td>
			</tr>
		</tbody>
	</form>
</table>
<!--<div id="msg" class="text-center icon-correct"></div>-->
<div id="ohsnap"></div>
