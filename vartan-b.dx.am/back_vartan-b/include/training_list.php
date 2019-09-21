<script>
	$(document).ready(function() {
		
		$(".show-more a").on("click", function() {
			var $this = $(this); 
			var $content = $this.parent().prev("div.content");
			var linkText = $this.text().toUpperCase();    
			
			if(linkText === "LÄS MER..."){
				linkText = "Dölj...";
				$content.switchClass("hideContent", "showContent", 100);
			} else {
				linkText = "Läs mer...";
				$content.switchClass("showContent", "hideContent", 100);
			};

			$this.text(linkText);
		});
		$(".edit").click(function() {
			var this_id = $(this).attr("id");
			var id = this_id.split("edit_");
				location="?p=edit_event&date=" + id[1];
		});
		$(".stats").click(function() {
			var this_id = $(this).attr("id");
			var id = this_id.split("check_");
				location="?p=check_player_attendance&date=" + id[1];
		});
		$(".delete").click(function() {
			var this_id = $(this).attr("id").split("delete_");
			var id = this_id[1];
			$.post("ajax/delete.php", {delete_event: 1, date: id}, 
				function(data){	
					if(data == 1){
						ohSnap('Evenemanget blev bort taget.', 'green');
						$("tr#date_" + id).fadeOut("slow", function(){$(this).remove()});
					}else{
						ohSnap('Det gick ej att ta bort evenemanget.', 'red');
					}
				}
			);
		});
		$("#p_page").change(function(){
			location = "?p=player_list&p_page=" + $(this).val();
		});		
	});
</script>
<table class="full-list text-center">
	<th>Datum</th>
	<th>Beskrivning</th>
	<th>Typ</th>
	<th>Alternativ</th>
	<tbody>
		<?php
			$color = 1;
			$test_query = mysqli_query($conn, "select * from dates order by date");
				while($response = mysqli_fetch_array($test_query, MYSQLI_ASSOC)){
					if($response['type'] == 1)
						$type = "Träning";
					else if($response['type'] == 2)
						$type = "Match";
					else if($response['type'] == 3)
						$type = "Möte";
						//<td class=\"wrapword\">
					echo "	<tr id=date_$response[date] ".(($color % 2 == 0)? 'style="background-color: #6495ED"':'style="background-color: #E6E6FA"').">
								<td>$response[date]</td>
								<td class=\"\">
									<div class=\"content hideContent \">".utf8_encode($response['description'])."</div>
									<div class=\"show-more\"><a href=\"#\">Läs mer...</a></div>
								</td>
								<td>$type</td>
								<td>
									<div class=\"options\">
											<span class=\"stats\" id=\"check_$response[date]\"> <img src=\"files/images/icons/stats.png\" /> </span>";
											if($_SESSION['lvl'] != 1 && $_SESSION['lvl'] != 0){
												echo "
													<span id=edit_$response[date] class=edit> <img src=files/images/icons/edit.png /> </span>
													<span id=delete_$response[date] class=delete> <img src=files/images/icons/delete.png /> </span>";
											}
					echo "			</div>
								</td>
							</tr>";
				$color++;
				}
		
		?>
	</tbody>
</table>
