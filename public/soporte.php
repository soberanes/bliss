<?php
if(isset($_POST['name']) && isset($_POST['email'])){
	$nombre  = $_POST['name'];
	$email   = $_POST['email'];
	$phone   = (isset($_POST['phone'])) ? $_POST['phone'] : '';
	$details = (isset($_POST['details'])) ? $_POST['details'] : '';
	
	$to = "paulsoberanes@gmail.com"; 
	$subject = "Incidencia en Catalogo Urrea"; 
	$body = "Has recibido un mensaje de la aplicacion Catalogo Urrea.<b /><b />
			 <strong>Nombre:</strong>".$nombre."<br/>
			 <strong>Email:</strong>".$email."<br/>
			 <strong>Telefono:</strong>".$phone."<br/>
			 <strong>Mensaje:</strong>".$details."<br/>"; 
	
	if (mail($to, $subject, $body)) {
		echo 1;  
	} else {
		echo 0;  
	}
	
}else{
	echo "error";
}
