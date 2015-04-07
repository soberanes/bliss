<?php
	$link = mysqli_connect("localhost","root","root","t3cn0lo1t3_c5_c0r3") or die("Error " . mysqli_error($link));

	$query = "SELECT user.user_id as user_id, user_info.fullname, user.username, user_control.password_text,  roles.role
			  FROM user_control
			  inner join user on user.user_id = user_control.user_id
			  inner join roles on roles.id = user.gid
			  inner join user_info on user_info.user_id = user_control.user_id" or die("Error in the consult.." . mysqli_error($link));

	$result = $link->query($query);

	while($row = mysqli_fetch_array($result)) { 
	  echo $row["name"] . "<br>"; 
	}

	mysqli_close($link);