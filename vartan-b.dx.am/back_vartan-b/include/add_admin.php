<?php
	if($_POST['insert']) {
		if($_POST['name'] && $_POST['username'] && $_POST['password'] && $_POST['lvl']) {
		
		$name = utf8_decode(mysqli_real_escape_string($conn, $_POST['name']));
		$username = utf8_decode(mysqli_real_escape_string($conn, $_POST['username']));
		$password = utf8_decode(mysqli_real_escape_string($conn, $_POST['password']));
		$lvl = ((int)$_POST['lvl']);
		$active = (($_POST['active']) ? '1':'0');
		
		$string = "insert into administration (`name`,`username`,`password`,`permission_lvl`,`active`) values ('$name','$username','".md5($password)."','$lvl', '$active')";
		
			if(mysqli_query($conn, $string)){?>
				<script>
					$(document).ready(function(){
						/*$("#msg").html("Jogador inserido com sucesso.").fadeIn("slow");
						$("#msg").css({"color":"green"});*/
						ohSnap('Administrador inserido com sucesso.', 'green');
					});
				</script>
			<?}else{//echo $string;?>
				<script>
					$(document).ready(function(){
						/*$("#msg").html("Jogador não foi inserido.").fadeIn("slow");
						$("#msg").css({"color":"red"});*/
						ohSnap('Administrador não foi inserido.', 'red');
					});
				</script>
			<?}
		}else{?>
			<script>
				$(document).ready(function(){
					/*$("#msg").html("Dados não foram completados para inserir.").fadeIn("slow");
					$("#msg").css({"color":"red"});*/
					ohSnap('Dados não foram completados para inserir.', 'yellow');
				});
			</script>
		<?}
	}
?>
<table class="halve-list text-left">
	<form method="POST">
		<tbody>
			<tr>
				<td>Nome</td>
				<td><input type="text" name="name" /></td>
			</tr>
			<tr>
				<td>Username</td>
				<td><input type="text" name="username" /></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="text" name="password" /></td>
			</tr>
			<tr>
				<td>LVL</td>
				<td>
					<select name="lvl">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Active</td>
				<td><input type="checkbox" name="active"></td>
			</tr>
			<tr>
				<td colspan="2" class="text-center"><input type="submit" name="insert" /></td>
			</tr>
		</tbody>
	</form>
</table>
<!--<div id="msg" class="text-center icon-correct"></div>-->
<div id="ohsnap"></div>

