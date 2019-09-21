<?php
	$q = "select (select count(*) from players where favorite_foot = 0 and !deleted and id != 23) as none_foot,
				(select count(*) from players where favorite_foot = 1 and !deleted and id != 23) as right_foot, 
				(select count(*) from players where favorite_foot = 2 and !deleted and id != 23) as left_foot, 
				(select count(*) from players where favorite_foot = 3 and !deleted and id != 23) as both_foot,
				
				(select count(*) from players where position = 1 and !deleted and id != 23) as none_position,
				(select count(*) from players where position = 2 and !deleted and id != 23) as GK,
				(select count(*) from players where position = 3 and !deleted and id != 23) as DR,
				(select count(*) from players where position = 4 and !deleted and id != 23) as DC,
				(select count(*) from players where position = 5 and !deleted and id != 23) as DL,
				(select count(*) from players where position = 6 and !deleted and id != 23) as MR,
				(select count(*) from players where position = 7 and !deleted and id != 23) as MDC,
				(select count(*) from players where position = 8 and !deleted and id != 23) as MC,
				(select count(*) from players where position = 9 and !deleted and id != 23) as ML,
				(select count(*) from players where position = 10 and !deleted and id != 23) as MO,
				(select count(*) from players where position = 11 and !deleted and id != 23) as ST,
				(select count(*) from players where !deleted and id != 23) as active_players,
				(select count(*) from players where deleted and id != 23) as inactive_players
				";
if(mysqli_num_rows($query = mysqli_query($conn, $q)) > 0){
		$info = mysqli_fetch_array($query, MYSQLI_ASSOC);?>
			<script type="text/javascript">
				$(function () {
					$('#chart1').highcharts({
						chart: {
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false
						},
						title: {
							text: 'Fotspel'
						},
						tooltip: {
							pointFormat: '<b>{point.percentage:.0f}%</b> ({point.y})'
						},
						plotOptions: {
							pie: {
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
									enabled: true,
									format: '<b>{point.name}</b>: {point.percentage:.0f} % ({point.y})',
									style: {
										color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
									}
								}
							}
						},
						series: [{
							type: 'pie',
							name: 'Fotspel',
							data: [<?echo "['NS', $info[none_foot] ], ['Höger Fot', $info[right_foot] ], ['Vänster Fot', $info[left_foot] ], ['Båda', $info[both_foot] ]";?>]
						}]
					});
					$('#chart2').highcharts({
						chart: {
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false
						},
						title: {
							text: 'Positioner'
						},
						tooltip: {
							pointFormat: '<b>{point.percentage:.0f}%</b> ({point.y})'
						},
						plotOptions: {
							pie: {
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
									enabled: true,
									format: '<b>{point.name}</b>: {point.percentage:.0f} % ({point.y})',
									style: {
										color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
									}
								}
							}
						},
						series: [{
							type: 'pie',
							name: 'Positioner',
							data: [
								<?echo "
										['NS', $info[none_position] ],
										['Målvakt', $info[GK] ],
										['Höger Back', $info[DR] ],
										['Mitt Back', $info[DC] ],
										['Vänster Back', $info[DL] ],
										['Höger Ytter Mittfältare', $info[MR] ],
										['Defensiv Mittfältare', $info[MDC] ],
										['Center Mittfältare', $info[MC] ],
										['Vänster Ytter Mittfältare', $info[ML] ],
										['Offensiv Mittfältare', $info[MO] ],
										['Anfallare/Striker', $info[ST] ]";?>

								]
						}]
					});
					$('#chart3').highcharts({
						chart: {
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false
						},
						title: {
							text: 'Player Activity'
						},
						tooltip: {
							pointFormat: '<b>{point.percentage:.0f}%</b> ({point.y})'
						},
						plotOptions: {
							pie: {
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
									enabled: true,
									format: '<b>{point.name}</b>: {point.percentage:.0f} % ({point.y})',
									style: {
										color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
									}
								}
							}
						},
						series: [{
							type: 'pie',
							name: 'Player Activity',
							data: [<?="['Inactive', $info[inactive_players] ], ['Active', $info[active_players] ]";?>]
						}]
					});
				});
		</script>
		<br>
		<div id="statsGraph">
			<div id="chart1" style="width: 100%; height: 400px;"></div>
			<div id="chart2" style="width: 100%; height: 400px;"></div>
			<div id="chart3" style="width: 100%; height: 400px;"></div>
		</div>
		<div id="statsNum">
		
		</div>
<?}else{
	echo "no data";
}?>

