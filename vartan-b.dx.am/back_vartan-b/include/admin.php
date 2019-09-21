<?php
	if($_GET['p'] == "admin" && $_SESSION["lvl"] == 3){?>
		<a href="?p=add_admin">Add Admin</a>
		<table class="full-list text-center">
			<th>ID</th>
			<th>Nome</th>
			<th>Username</th>
			<th>LVL</th>
			<th>Último Login</th>
			<th>Activo</th>
			<th>Opções</th>
			<tbody>
				<?php
					if(mysqli_num_rows($request = mysqli_query($conn, "select * from administration"))){
						while($response = mysqli_fetch_array($request, MYSQLI_ASSOC)){
							echo "
							<tr>
								<td>$response[id]</td>
								<td>".utf8_encode($response["name"])."</td>
								<td>".utf8_encode($response["username"])."</td>
								<td>$response[permission_lvl]</td>
								<td>$response[last_login]</td>
								<td>".(($response["active"]) ? 'Sim':'Não')."</td>
								<td>
									<div class=\"options\">
										<span id=edit_$response[id] class=edit><img src=files/images/icons/edit.png /></span>
										<span id=delete_$response[id] class=delete><img src=files/images/icons/delete.png /></span>
									</div>
								</td>
							</tr>
							";
						}
					}else{
						echo "Erro de query";
					}?>
			</tbody>
		</table>
<?}else{?>Alguma coisa deu errado : /<?}?>
