<!--CSS-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="files/css/general.css" />
<link rel="stylesheet" type="text/css" href="files/css/ohsnap.css" />

<!--SCRIPTS-->
<script src="files/js/jquery-1.11.0.js"></script>
<script src="files/js/jquery-ui.custom.js"></script>
<script src="files/js/ohsnap.js"></script>
<script src="files/js/highcharts.js"></script>
<script src="files/js/exporting.js"></script>
<script>
	$(document).ready(function() {
		$("#player_list").click(function(){
			location="index2.php?p=" + $(this).attr('id');
		});
		$("#add_player").click(function(){
			location="index2.php?p=" + $(this).attr('id');
		});
		$("#training_list").click(function(){
			location="index2.php?p=" + $(this).attr('id');
		});
		$("#add_event").click(function(){
			location="index2.php?p=" + $(this).attr('id');
		});
		$("#admin").click(function(){
			location="index2.php?p=" + $(this).attr('id');
		});
		$("#logout").click(function(){
			location="index2.php?p=" + $(this).attr('id');
		});
	});
</script>
