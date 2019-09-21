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
				//if(mysqli_query($conn, "insert into dates (`date`,`description`, `type`) value ('$_POST[date]','$description', '$_POST[type]')")){
				if(mysqli_query($conn, "update dates set description = '".$_POST["description"]."', type = '".$_POST["type"]."' where date = '".$_POST["date"]."' ")){?>
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
<?php 
	if(mysqli_num_rows($request = mysqli_query($conn, "select * from dates where date = '".$_GET["date"]."'")) > 0){
		$object = mysqli_fetch_array($request, MYSQLI_ASSOC);
?>
<script src="files/js/ckeditor_basic/ckeditor.js"></script>
<script>
	$(document).ready(function(){
		$("#datepicker").datepicker({ 	dateFormat: "yy-mm-dd",
										showWeek: true, 
										gotoCurrent: true,
										firstDay: 1, 
										weekHeader: "Vk",
										dayNamesMin: ["Sö","Må","Ti","On","To","Fr","Lö"],
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
			<td><input type="text" name="date" id="datepicker" placeholder="Tryck här" value="<?=$_GET["date"]?>" />
				<select name="type">
					<option value="1" <?=(($object["type"] == 1)? "selected=selected":"");?> >Träning</option>
					<option value="2" <?=(($object["type"] == 2)? "selected=selected":"");?> >Match</option>
					<option value="3" <?=(($object["type"] == 3)? "selected=selected":"");?> >Möte</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<textarea class="ckeditor" name="description" cols="35" rows="15"><?=utf8_encode($object["description"])?></textarea>
			</td>
		</tr>
		<tr>
			<td><input name="submit" type="submit" value="Inserir" /></td>
		</tr>
	</form>
</table>
<?}?>
