<?php
	$token = $_GET['token'];
	if($token != "9c9b975zX7d5P70997166nhNgfCV5PID"){
		die('Imposible acceder a este recurso');
	}

	$link = mysqli_connect("localhost","root","root","t3cn0lo1t3_c5_c0r3") or die("Error " . mysqli_error($link));

	$query = "SELECT user.user_id as user_id, user_info.fullname, user.username, user_control.password_text, 
			  roles.role, sucursales.nombre as sucursal, distribuidores.nombre as distribuidor, credits.credit as credito
			  FROM user_control
			  inner join user on user.user_id = user_control.user_id
			  inner join roles on roles.id = user.gid
			  inner join user_info on user_info.user_id = user_control.user_id
			  left join sucursales on sucursales.sucursal_id = user_info.sucursal
			  left join distribuidores on distribuidores.distribuidor_id = sucursales.distribuidor 
			  left join credits on credits.user_id = user.user_id
			  where user.user_id not in(238,239) order by user.user_id" or die("Error in the consult.." . mysqli_error($link));

	$result = $link->query($query)
	
?>
<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Nombre completo</th>
			<th>Nombre de usuario</th>
			<th>Password</th>
			<th>Perfil</th>
			<th>Sucursal</th>
			<th>Distribuidor</th>
			<th>Puntos disponibles</th>
			<th>Puntos acumulados</th>
			<th>Puntos canjeados</th>
		</tr>
	</thead>
	<tbody>
		<?php while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){ ?>

			<tr>
				<th><?php echo $row["user_id"] ?></th>
				<th><?php echo $row["fullname"] ?></th>
				<th><?php echo $row["username"] ?></th>
				<th><?php echo $row["password_text"] ?></th>
				<th><?php echo $row["role"] ?></th>
				<th><?php echo $row["sucursal"] ?></th>
				<th><?php echo $row["distribuidor"] ?></th>
				<th><?php echo $row["credito"] ?></th>
				<th><?php echo $row["credito"] ?></th>
				<th><?php echo $row["credito"] ?></th>
			</tr>

		<?php } ?>
	<tbody>
</table>
		
<?php

	mysqli_close($link);