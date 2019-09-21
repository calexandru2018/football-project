<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="files/css/login.css" />
		<script src="files/js/jquery-1.11.0.js"></script>
		<script>
			$(document).ready(function() {
				function GetURLParameter(sParam) {
					var sPageURL = window.location.search.substring(1);
					var sURLVariables = sPageURL.split('&');
					
					for (var i = 0; i < sURLVariables.length; i++) {
						var sParameterName = sURLVariables[i].split('=');
						if (sParameterName[0] == sParam) {
							return sParameterName[1];
						}
					}
				};
				
				var e = GetURLParameter('e');
				if(e==1){
					$("#error").html('One of the fields were left in blank');
					$("#error").fadeIn("slow");
				}else if(e==2){
					$("#error").html('Some inserted data was incorrect');
					$("#error").fadeIn("slow");
				}else if(e > 2){
					$("#error").html('Some minor error ocurred');
					$("#error").fadeIn("slow");
				}
				
				function date_stamp() {
					var DateTime = new Date();
					var date = DateTime.getFullYear() + "-" + (DateTime.getMonth() + 1) + "-" + DateTime.getDate() + " " + DateTime.getHours() + ":" + DateTime.getMinutes() + ":" + DateTime.getSeconds();
					return date;
				}
				$("#login").submit(function() {
					var date = date_stamp();
					$("#date").val(date);
				});
			});				
			
			
		</script>
	</head>
	<body>
		<form id="login" action="general/verify.php" method="post">
			<table>
				<tr>
					<td><input type="text" name="username" placeholder="username" /></td>
					<td><input type="password" id="password" name="password" placeholder="password" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Logga in" /></td>
				</tr>
				<tr>
					<td colspan="2"></div></td>
				</tr><tr>
					<td colspan="2"><div id="error"></div></td>
				</tr>
				<input type="hidden" id="date" name="date" value="" />
			</table>
		</form>
	</body>
</html>
