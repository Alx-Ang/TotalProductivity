    <?php
	
	session_start();
	
	if(!isset($_SESSION['id_usuario'])){
		header("Location: mainAreas.php");
	}
    $nombre_usuario = $_SESSION['nombre_usuario'];
	
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <style>@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');</style>
    <link rel="stylesheet" href="css/styleArea.css">

    <title>Total Productivity</title>
</head>
<body>
    <nav>
        <h3>TOTAL PRODUCTIVITY</h3>
        <ul>
            <li><a><i class="uil uil-user"></i></a>
                <ul>
                    <li><a href="php/logout.php"><i class="uil uil-sign-out-alt"></i></a></li>
                </ul>
            </li>
            <li><a><?php echo $nombre_usuario; ?> </a></li>
        </ul>
    </nav>

    <?php
        include "php/conexion.php";

        $query = mysqli_query($mysqli, "SELECT areas.area_nombre FROM usuarios,areas where areas.id_area=usuarios.area_id and usuarios.nombre_usuario='".$nombre_usuario."' ");
        $result = mysqli_num_rows($query);  
    ?>

    <div class="">
        <h1 class="title">AREAS MENU</h1>
        <p class="description">Welcome! If you have an area you can enter</p>
    </div>
    
    <?php
	    if ($result > 0) {
        while ($data = mysqli_fetch_assoc($query)) { ?>
    <section class="card">
		<div class="card_area">
		    <div class="card_name">
			    <h2><?php echo $data['area_nombre']; ?></h2>
                <p class="description">Seleccione una imagen para su area</p> 
		    </div>
            <hr>
            
            <div class="card_img">
                <p class="description">Imagen del area</p>
            </div>
            <hr>
                
            <div class="card_button">
                <form action="dashboard.php" method="POST">
                    <a class="link">    
                        <input type="hidden" name="pefil_id" value="0">
                        <input type="submit" value="Enter">
                    </a>
                </form>
            </div>           
        </div>
    </section>
    <?php }
    } ?>    
</body>
</html>
    