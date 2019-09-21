<!--CSS-->
<link rel="stylesheet" type="text/css" href="files/css/general.css" />

<!--SCRIPTS-->
<script src="files/js/jquery-1.11.0.js"></script>

<script>
	function DisplayDateTime() {
		var DateTime = new Date();
		var date = DateTime.getFullYear() + "-" + (DateTime.getMonth() + 1) + "-" + DateTime.getDate() + " " + DateTime.getHours() + ":" + DateTime.getMinutes() + ":" + DateTime.getSeconds();
		return date;
	}
	$(document).ready(function() {
		$("#log").click(function() {
			$.post("ajax/check.php",{login: 1, id_player: $("#password").val(), date: DisplayDateTime()},
				function(data){
					if(data==1){
						location=$("#url").val();
					}else{
						$("#msg").html("Ogiltig information.").fadeIn("slow");
						$("#msg").css({"color":"red"});
					}
				}
			);
		});
	<?if(isset($_SESSION["uid"]) && $_SESSION["uid"] != "0"){?>
		$("input[name='attendance']").change(function() {
			if($("[name='attendance']:checked").val() == 1){
				if($("#explanation").is(":visible")){
					$("#explanation").fadeOut("slow");
				}
			}else{
				$("#explanation").fadeIn("slow");
			}
		});
		$("#confirm_attendance").click(function() {
			$.post("ajax/players_choices.php", {confirm_attendance: 1, date: $("#date").val(), id_player: <?=$_SESSION["uid"];?>, option: $("[name='attendance']:checked").val(), explanation: $("textarea#textarea_explanation").val()},
				function(data){
					if(data==1){
						location=$("#url").val();
					}else if(data==55){
						$("#msg").html("Måste ge en förklaring!").fadeIn("slow");
						$("#msg").css({"color":"red"});
					}else if(data==56){
						$("#msg").html("Du har redan svarat på eventet!").fadeIn("slow");
						$("#msg").css({"color":"red"});
					}else{
						alert("error:" + 12);
					}
				}
			);
		});
		$("#update").click(function() {
			$.post("ajax/players_choices.php", {update: 1, id_player: <?=$_SESSION['uid']?>, favorite_foot: $("#favorite_foot").val(), position: $("#position").val()}, 
				function(data){
					if(data==1)
						location=$("#url").val();
					else
						alert("error:" + 13)
				}
			)		
		});
		
		$("#main").click(function(){
			$("#player_information").fadeIn("slow");
			$("#contacts").css({"display":"none"});
		});
		$("#contact").click(function(){
			$("#contacts").fadeIn("slow");
			$("#player_information").css({"display":"none"});
		});
		$("#logout").click(function(){
			$.post("general/logout.php",{logout: 1},
				function(data){
					if(data==1) 
						location="index.php";
					else
						alert("error:" + 14);
				}
			)
		});
		//$(".logout").bind("click",function(){$("#cover").css({"display":"block"},"slow");$.post("general/logout.php",{logout: 1, url: $("#url").val()},function(data){if(data==1){location="index.php";} })});
	<?}?>
	});
</script>

