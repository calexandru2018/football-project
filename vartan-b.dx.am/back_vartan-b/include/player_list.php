<script>
	$(document).ready(function() {
		//add index column with all content.
		/*$(".players_list tr:has(td)").each(function(){
			var t = $(this).text().toLowerCase(); //all row text
			$("<td class='indexColumn'></td>").hide().text(t).appendTo(this);
		});//each tr
			
		$("#search_input").keyup(function(){
			var s = $(this).val().toLowerCase().split(" ");
			//show all rows.
			$(".players_list tr:hidden").shoselect players.*, positions.*, positions.position as positions_position, players.id as id_player from players, positions where !players.deleted and players.position=positions.idw();
			$(".players_list tr:hidden").animate({marginTop: 0}, 50, function(){$(this).show()});
			$.each(s, function(){
			  $(".players_list tr:visible .indexColumn:not(:contains('" + this + "'))").parent().hide();
			});//each
		});//key up.
	
		$('#search_input').keyup(function() {
			var that = this;
			//var that = $(this).val().toLowerCase().split(" ");
			$.each($('tr:has(td)'),	function(i, val) {
				if ($(val).text().indexOf($(that).val()) == -1) {
					$('.players_list').animate({marginTop: 0},50,function() {$('tr:has(td)').eq(i).hide();});
				} else {
					$('.players_list').animate({marginTop: 0},50,function() {$('tr:has(td)').eq(i).show();});
				}
			});
		});*/
		$(".edit").click(function() {
			var this_id = $(this).attr("id");
			var id = this_id.split("edit_");
				location="?p=edit_player&player_id=" + id[1];
		});
		$(".stats").click(function() {
			var this_id = $(this).attr("id");
			var id = this_id.split("stats_");
				location="?p=stats_player&player_id=" + id[1];;
		});
		$(".delete").click(function() {
			var this_id = $(this).attr("id").split("delete_");
			var id = this_id[1];
			$.post("ajax/delete.php", {delete_player: 1, player_id: id}, 
				function(data){	
					if(data == 1){
						ohSnap('Spelare borttagen.', 'green');
						$("tr#player_" + id).fadeOut("slow", function(){$(this).remove()});
					}else{
						ohSnap('Det gick ej att ta bort spelaren.', 'red');
					}
				}
			);
		});
		$("#p_page").change(function(){
			location = "?p=player_list&p_page=" + $(this).val();
		});		
	});
	
</script>
<!--<div id="search_tab">
	<input type="text" id="search_input" placeholder="search">
</div>-->
<div style="float: right">
	<select id="p_page">
		<option value="8"  <?=(($_GET["p_page"] == 8)? "selected=selected":"");?> >8</option>
		<option value="10" <?=(($_GET["p_page"] == 10)? "selected=selected":"");?> >10</option>
		<option value="15" <?=(($_GET["p_page"] == 15)? "selected=selected":"");?> >15</option>
		<option value="20" <?=(($_GET["p_page"] == 20)? "selected=selected":"");?> >20</option>
	</select>
</div>
<table class="full-list text-center">
	<th>ID</th>
	<th>Namn</th>
	<th>Spelfot</th>
	<th>Position</th>
	<th>Ålder</th>
	<th>Senast inloggad</th>
	<th>Alternativ</th>
	<tbody>
		<?php
			$color = 1;
			
			if($_GET["p_page"])					 
				$per_page = intval($_GET["p_page"]);
			else
				$per_page = 8;
				
			if($_GET["page"])
				$page = intval($_GET["page"]);
			else
				$page = 1;
				
			$calc = $per_page * $page;
			$start = $calc - $per_page;
			
			$sql_test2 = mysqli_query($conn, "select players.*, positions.*, positions.position as positions_position, players.id as id_player from players, positions where players.id != 23 and !players.deleted and players.position=positions.id limit $start, $per_page");
				if($rows = mysqli_num_rows($sql_test2) > 0){
					$i = 0;
			
					while($response = mysqli_fetch_array($sql_test2, MYSQLI_ASSOC)){
						if($response['favorite_foot'] == 1){
							$foot = "Höger fot";
						}else if($response['favorite_foot'] == 2){
							$foot = "Vänster fot";
						}else if($response['favorite_foot'] == 3){
							$foot = "Båda";
						}else{
							$foot = "--Välja--";
						}
							
						$bday =	new DateTime($response['age']);
						//Differentiating both dates
						$age=$bday->diff(new DateTime);
						$average_age = $average_age + $age->y;
						echo "	<tr id=player_$response[id_player] ".(($color % 2 == 0)? 'style="background-color: #6495ED"':'style="background-color: #E6E6FA"').">
									<td>$response[id_player]</td>
									<td>".utf8_encode($response['name'])."</td>
									<td>$foot</td>
									<td>".utf8_encode($response['positions_position'])."</td>
									<td>$age->y</td>
									<td>".(($response["last_login"])? $response["last_login"]:'Inget')."</td>
									<td>
										<div class=\"options\">
											<span id=\"stats_$response[id_player]\" class=\"stats\"><img src=\"files/images/icons/stats2.png\" /></span>";
											if($_SESSION['lvl'] != 1 && $_SESSION['lvl'] != 0){
												echo "
													<span id=edit_$response[id_player] class=edit><img src=files/images/icons/edit.png /></span>
													<span id=delete_$response[id_player] class=delete><img src=files/images/icons/delete.png /></span>";
											};
						echo "			</div>
									</td>	
								<tr>";
					$color++;
					}	
				}else{
					echo "Det finns inga registrerade spelare";
				}?>				
	</tbody>
</table>
<div class="pagination">
	<? if(isset($page)){
		$result = mysqli_query($conn,"select count(*) as Total from players where !deleted and id != 23");
		
		if(mysqli_num_rows($result) > 0){
			$rs = mysqli_fetch_assoc($result);
			$total = $rs["Total"];
		}
		
		$totalPages = ceil($total / $per_page);
		
		if($page <=1 ){
			echo "<span id='page_links' style='font-weight: bold;'> Föregående </span>";//where there are no more pages to go back
		}else{
			$j = $page - 1;
			echo "<span><a id='page_a_link' href='?p=player_list".(($_GET["p_page"]) ? "&p_page=$_GET[p_page]" : "")."&page=$j'> Föregående </a></span>";//go to previous page
		}
		
		for($i=1; $i <= $totalPages; $i++){
			if($i<>$page){
				echo "<span><a id='page_a_link' href='?p=player_list".(($_GET["p_page"]) ? "&p_page=$_GET[p_page]" : "")."&page=$i'> $i </a></span>";//different page as page number
			}else{
				echo "<span id='page_links' style='font-weight: bold; color:green;'> $i </span>";	//actual page as page number
			}
		}
		
		if($page == $totalPages ){
			echo "<span id='page_links' style='font-weight: bold;'> Nästa </span>";//where there are no more pages to go
		}else{
			$j = $page + 1;
			echo "<span><a id='page_a_link' href='?p=player_list".(($_GET["p_page"]) ? "&p_page=$_GET[p_page]" : "")."&page=$j'> Nästa </a></span>";//go to next page
		}
	}?>
</div>
<div id="ohsnap"></div>
