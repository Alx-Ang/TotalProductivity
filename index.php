<?php
	
	require "system/php/conexion.php";

	session_start();
	
	if($_POST){
        $alert = "";
		$email = $_POST['email'];
		$contrasena = $_POST['contrasena'];
		
		$sql = "SELECT id_usuario, email, contrasena, nombre_usuario, perfil_id FROM usuarios WHERE email='$email'";

		$result = $mysqli->query($sql);
		$num = $result->num_rows;
		
		if($num>0){
			$row = $result->fetch_assoc();
			$password_bd = $row['contrasena'];
			
			$pass_c = ($contrasena);
			
			if($password_bd == $pass_c){
				
				$_SESSION['id_usuario'] = $row['id_usuario'];
                $_SESSION['nombre_usuario'] = $row['nombre_usuario'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['perfil_id'] = $row['perfil_id'];
				
				header("Location: system/dashboard.php");	

			} else {
            $alert = '<center><p class="alert">
                    Incorrect password try again </p></center>';
            }
			} else {
            $alert = '<center><p class="alert">
                    The email address has not yet been registered </p></center>';
		}	
	}	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');</style>
    <link rel="stylesheet" href="system/css/stylesLoginPassword.css">
    
    <title>Total Productivity</title>
</head>
<body>
    <div class="container">
        <div class="forms">
            <!-- Inicio de sesion -->
            <div class="form login">
                <h1 class="title">LOGIN</h1>

                    <span class="alert"><?php echo isset($alert) ? $alert : ''; ?><span>

                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" name="contrasena" placeholder="Enter your password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>
                        <a href="passwordReset.php" class="text">Forgot Password?</a>
                    </div>

                    <div class="input-field button">
                        <input type="submit" value="Login">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Not a member?
                        <a href="register.php" class="text">Signup Now</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
        <script src="system/js/script.js"></script>
</body>
</html>