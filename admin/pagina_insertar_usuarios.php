<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

<?php

	$nombre= $_POST["nom"];
	$apellido= $_POST["ape"];
	$usuario= $_POST["usu"];
	$contrasenia= $_POST["contra"];
	$pass_cifrado=password_hash($contrasenia, PASSWORD_DEFAULT);			
	try{

		$base=new PDO('mysql:host=localhost; dbname=vlcc', 'root', '');
		
		$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$base->exec("SET CHARACTER SET utf8");		
		
		
		$sql="INSERT INTO usuario (nombre, apellido, nombre_usuario, password) VALUES (:nom, :ape, :usu, :contra)";
		
		$resultado=$base->prepare($sql);		
		
		
		$resultado->execute(array(":nom"=>$nombre, ":ape"=>$apellido , ":usu"=>$usuario, ":contra"=>$pass_cifrado));		
		
		?>
		<script>
        alert('Error Vuelva a ingresar...');
            </script>
			<?php
		echo "Usuario Registrado";
		header("location:panel.php");
		$resultado->closeCursor();

	}catch(Exception $e){			
		echo "Línea del error: " . $e->getLine();
	}finally{
		$base=null;	
	}
?>
</body>
</html>