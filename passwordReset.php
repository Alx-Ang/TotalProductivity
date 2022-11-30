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
    <?php

    if(isset($_POST['codigo'])){

        require "system/php/conexion.php";

        $alert = "";
        $email = $mysqli->real_escape_string($_POST['email']);

        $sql = $mysqli->query("SELECT nombre_usuario, email FROM usuarios WHERE email = '$email'");
        $row = $sql->fetch_array();
        $count = $sql->num_rows;

        if($count == 1) {

        $token = uniqid();

        $act = $mysqli->query("UPDATE usuarios SET token = '$token' WHERE email = '$email'");

        //correo electronico
        $email_to = $email;
        $email_subject = "Cambio de contraseña";
        $email_from = "reply.totalproductivity.com";

        $email_message = "Hola " . $row['nombre_usuario'] . ", al parecer has solicitado cambiar de contraseña, si no has sido tu te pedimos que ignores este correo, para continuar con el cambio de contraseña debes de acceder al siguiente link\n\n";
        $email_message .= "https://totalproductivity.000webhostapp.com/newpassword.php?user=".$row['nombre_usuario']."&token=".$token."\n\n";

        $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n\" .
        'X-Mailer: PHP/'" . phpversion();
        @mail($email_to, $email_subject, $email_message, $headers);

        $alert = '<center><p class="alert-good">
                    An email has been sent to reset your password </p></center>';

        }else{
            $alert = '<center><p class="alert">
            This email is not registered </p></center>';
        }
    }

    ?>
    <div class="container">
        <div class="forms">
            <!--Recuperacion de contraseña-->
            <div class="form passwordReset">
                <h1 class="title">RESET PASSWORD</h1>
                    <span class="alert"><?php echo isset($alert) ? $alert : ''; ?><span>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    
                    <div class="login-signup">
                        <span class="text">Don’t worry! We’ll send you password reset link</span>
                    </div>
                        
                    <div class="input-field button">
                        <input type="submit" name="codigo" value="Send email">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Already have an account?
                        <a href="index.php"  class="text" >Log in</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

