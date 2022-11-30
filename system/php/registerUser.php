<?php

	include 'conexion.php';

    $alert = "";
	$nombre_usuario=$_POST['nombre_usuario'];
	$nomina=$_POST['nomina'];
	$perfil_id=$_POST['perfil_id'];
	$puesto=$_POST['puesto'];
	$email=$_POST['email'];
	$contrasena=$_POST['contrasena'];
	$nombre_area=$_POST['nombre_area'];
	$status=$_POST['status'];

	$query = "INSERT INTO usuarios (nombre_usuario, nomina, perfil_id, puesto, email, contrasena, nombre_area,status) VALUES ('$nombre_usuario', '$nomina', '$perfil_id', '$puesto', '$email', '$contrasena', '$nombre_area', '$status')";

	$runFile = mysqli_query($mysqli, $query);
	if ($runFile) {
        echo '
		<script>
			alert("Usuario registrado");
			window.location="../../index.php";
			</script>
		';
	}else{
        echo '
		<script>
			alert("Intentalo de nuevo, el email ya se encuentra registrado");
			window.location="../../register.php";
			</script>
		';
	}


	
	mysqli_close($mysqli);
?>