<?php

	include 'system/php/conexion.php';

    if($_POST){
        
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

        $verificar_email = mysqli_query($mysqli, "SELECT *FROM usuarios WHERE email='$email'");
	    if (mysqli_num_rows($verificar_email)>0) {
            echo '<script>
			alert("¡ The email is already registered by a user !");
			location = "register.php";
			</script>';
		exit();
        }

        $runFile = mysqli_query($mysqli, $query);
        if ($runFile) {
            $alert = '<center><p class="alert-good">
            User successfully registered </p></center>';
            
        }else{
            $alert = '<center><p class="alert-bad">
            ¡ The user could not be registered ! </p></center>';
	    }
    }
	mysqli_close($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');</style>
    <link rel="stylesheet" href="system/css/stylesRegister.css">
    
    <title>Total Productivity</title>
</head>
<body>
    <div class="container_register">
        
        <div class="content">
            <h1 class="title">REGISTRATION</h1>
            
                <span><?php echo isset($alert) ? $alert : ''; ?><span>

            <form action=""<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <input type="text" name="nombre_usuario" placeholder="Enter your user name" required>
                    </div>
                    <div class="input-box">
                        <input type="text" name="nomina" placeholder="Enter your payroll number" required>
                    </div>

                    <div class="input-box">
                        <div class="column">
                            <div class="select-box">
                                <select name="perfil_id" require>
                                    <option selected disabled>Select your profile type</option>
                                    <option value="1">Administrator</option>
                                    <option value="2">Supervisor</option>
                                    <option value="3">User</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="input-box">
                        <input type="text" name="puesto" placeholder="Enter your work position" required>
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="input-box">
                        <input type="password" name="contrasena" placeholder="Enter your password" pattern="[a-z A-z 0-9]+" maxlength="15" minlength="8" required>
                    </div>
                    
                    <div class="input-box">
                        <input type="text" name="nombre_area" placeholder="Enter your area name" required>
                    </div>

                    <div class="input-box">
                        <input type="text" name="status" value="Activo" readonly required>
                    </div>

                </div>

                <div class="input-box button">
                    <input type="submit" value="Register">
                </div>
    
            </form>
    
            <div class="form-register">
                <span class="text">Already have an account?
                    <a class="text" href="index.php" >Log in</a>
                </span>
            </div>

        </div>
    </div>
</body>
</html>
 