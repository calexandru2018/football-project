<?php
	if($_POST['submit']) {
		if(!$_POST['date']){
			?>
				<script>
					$(document).ready(function(){
						//$("#msg").html("Treino não foi inserido.").fadeIn("slow");
						ohSnap('Det finns inget valt datum.', 'red');
					});
				</script>
			<?
		}else if(!$_POST['description']){
			?>
				<script>
					$(document).ready(function(){
						//$("#msg").html("Treino não foi inserido.").fadeIn("slow");
						ohSnap('Det lades ej till någon text.', 'red');
					});
				</script>
			<?
		}else{
			$description = utf8_decode(mysqli_real_escape_string($conn, $_POST['description']));
				if(mysqli_query($conn, "insert into dates (`date`,`description`, `type`) value ('$_POST[date]','$description', '$_POST[type]')")){?>
					<script>
						$(document).ready(function(){
							//$("#msg").html("Treino inserido com sucesso.").fadeIn("slow", 2000);
							ohSnap('Evenemanget är nu tillagt.', 'green');
						});
					</script>
				<?}else{?>
					<script>
						$(document).ready(function(){
							//$("#msg").html("Treino não foi inserido.").fadeIn("slow");
							ohSnap('Evenemanget blev ej tillagt.', 'red');
						});
					</script>
				<?}
		}
	}
?>
<script src="files/js/ckeditor_basic/ckeditor.js"></script>
<script>
	$(document).ready(function(){
		$("#datepicker").datepicker({ 	dateFormat: "yy-mm-dd",
										showWeek: true, 
										firstDay: 1, 
										weekHeader: "Vk",
										dayNamesShort: [ "Son", "Mån", "Tis", "Ons", "Tor", "Fre", "Lör" ],
										monthNames: [ "Januari", "Februari", "Mars", "April", "Maj", "Juni", "Juli", "Augusti", "September", "Oktober", "November", "December" ]										
									}
		);
		
	});
</script>
<!--<div id="msg" style="display:none"></div>-->
<div id="ohsnap"></div>
<table class="halve-list text-center">
	<form method="POST">
		<tr>
			<td><input type="text" name="date" id="datepicker" placeholder="Tryck här" />
				<select name="type">
					<option value="1">Träning</option>
					<option value="2">Match</option>
					<option value="3">Möte</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<textarea class="ckeditor" name="description" cols="35" rows="15"></textarea>
			</td>
		</tr>
		<tr>
			<td><input name="submit" type="submit" value="Inserir" /></td>
		</tr>
	</form>
</table>
