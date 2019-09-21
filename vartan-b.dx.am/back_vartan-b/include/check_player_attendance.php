<script>
	$(document).ready(function(){
		$(".attendent").on("change", function(){
			var this_id = $(this).attr("id");
			var id = this_id.split("attendentid_");
			var change = $(this).val(); 
			
			if(change == 1){
				$("span#description_"+id[1]).html("");
				$.post("ajax/functions.php",{attendance_change: 1, type_of_change: 1, playerid: id[1], date: '<?=$_GET["date"];?>'},
					function(data){
						console.log(data);
						if(data == 1){
							ohSnap('Presenca e explicacao alterada', 'green');
						}else{
							//console.log(data);
							ohSnap('Ocorreu um erro', 'red');
						}
					}
				);
			}else if(change == 2){
				$("span#description_"+id[1]).replaceWith("<textarea id=explanation_"+id[1]+"></textarea>");
				$("#explanation_"+id[1]).focusout(function(){
					var text = $(this).val();
					
					$.post("ajax/functions.php",{attendance_change: 1, type_of_change: 2, playerid: id[1], explanation: text, date: '<?=$_GET["date"];?>'},
						function(data){
							if(data == 1){
								$("#explanation_"+id[1]).replaceWith("<span id=description_"+id[1]+">"+text+"</span>");
								ohSnap('Presenca e explicacao alterada', 'green');
							}else{
								ohSnap('Ocorreu um erro', 'red');
							}
						}
					);
				});
			}
		});
	});
</script>
<table class="full-list text-center">
	<thead>
		<tr>
			<th colspan="3"><b>Datum: <?=$_GET["date"];?></b></th>
		</tr>
		<tr>
			<th class="header-color">Namn</th>
			<th class="header-color">Närvaro</th>
			<th class="header-color">Förklaring</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$y = 0;
		$n = 0;
			if(mysqli_num_rows($query = mysqli_query($conn, "SELECT attendances.* , players.name, players.deleted, players.id as playersid FROM attendances, players 
																			WHERE attendances.player_id = players.id AND attendances.date =  '$_GET[date]' AND !players.deleted"))) {
				while($fetch_info = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
					if($fetch_info[attendance] == 1)
						$y++;
					else
						$n++;
						
					echo "
						<tr ".(($color % 2 == 0)? 'style="background-color: #6495ED"':'style="background-color: #E6E6FA"')."  >
							<td>".utf8_encode($fetch_info["name"])."</td>
							<td>";	
								if($_SESSION['lvl'] > 1){
									echo "
										<select id=attendentid_$fetch_info[playersid] class=attendent >
											<option value=1 ".(($fetch_info["attendance"] == 1)? "selected=selected":"").">Ja</option>
											<option value=2 ".(($fetch_info["attendance"] == 2)? "selected=selected":"").">Nej</option>
										</select>
									";
								}else{
									echo (($fetch_info["attendance"] == 1) ? "Ja":"Nej");
								}
							echo "</td>
							<td class=\"wrapword\">
								<span id=description_$fetch_info[playersid]>".utf8_encode($fetch_info["attendance_description"])."</span>
							</td>
						</tr>";
				}
				echo "
					<div style=\"width: 100%; text-align: center; font-weight: bold; margin-top: 5px; margin-bottom: 5px \">
						Vieram: $y || Não vieram: $n || Total: ",$y+$n,"
					</div>";
			}			
		?>
	</tbody>
</table>
<div id="ohsnap"></div>
