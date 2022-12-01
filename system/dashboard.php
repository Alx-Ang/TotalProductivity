<?php	
	session_start();
	
	if(!isset($_SESSION['id_usuario'])){
		header("Location: dashboard.php");
	}
    $nombre_usuario = $_SESSION['nombre_usuario'];
    $perfil = $_SESSION['perfil_id'];
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');</style>
    <link rel="stylesheet" href="css/stylesDashboard.css">

    <title>Total Productivity</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <!--<div class="logo-image">
                <img src="img/logo.png" alt="">
            </div>-->

            <span class="logo_name">Total Productivity</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
            <?php if($perfil == 1) { ?>
                <li><a href="#">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dahsboard</span>
                </a></li>
                <li><a href="areas.php">
                    <i class="uil uil-map-marker"></i>
                    <span class="link-name">Areas</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-setting"></i>
                    <span class="link-name">Work Center</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-layers"></i>
                    <span class="link-name">Raw Materials</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-box"></i>
                    <span class="link-name">Product</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-users-alt"></i>
                    <span class="link-name">Staff</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-map-pin-alt"></i>
                    <span class="link-name">Production Route</span>
                </a></li>
                <li><a href="#">
                <i class="uil uil-analytics"></i>
                    <span class="link-name">Eficiencies</span>
                </a></li>
            <?php }?>
                <li><a href="#">
                    <i class="uil uil-shield-exclamation"></i>
                    <span class="link-name">Problems</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-edit-alt"></i>
                    <span class="link-name">Supervisors Form</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-edit-alt"></i>
                    <span class="link-name">Production Form</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a  href="mainAreas.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
            
            <span class="text"> <?php echo $nombre_usuario;?> </span>
            <img src="img/user.png" alt="">
                
        </div>

        <div class="dash-content">
            <!--<div class="overview">
                <div class="title">
                    i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text"> Dashboard General </span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="text">Total Likes</span>
                        <span class="number">50,120</span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-comments"></i>
                        <span class="text">Comments</span>
                        <span class="number">20,120</span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-share"></i>
                        <span class="text">Total Share</span>
                        <span class="number">10,120</span>
                    </div>
                </div>
            </div>-->

            <!--<div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Activity</span>
                </div>

                <div class="activity-data">
                    <div class="data names">
                        <span class="data-title">Name</span>
                        <span class="data-list">Prem Shahi</span>
                        <span class="data-list">Deepa Chand</span>
                        <span class="data-list">Manisha Chand</span>
                        <span class="data-list">Pratima Shahi</span>
                        <span class="data-list">Man Shahi</span>
                        <span class="data-list">Ganesh Chand</span>
                        <span class="data-list">Bikash Chand</span>
                    </div>
                    <div class="data email">
                        <span class="data-title">Email</span>
                        <span class="data-list">premshahi@gmail.com</span>
                        <span class="data-list">deepachand@gmail.com</span>
                        <span class="data-list">prakashhai@gmail.com</span>
                        <span class="data-list">manishachand@gmail.com</span>
                        <span class="data-list">pratimashhai@gmail.com</span>
                        <span class="data-list">manshahi@gmail.com</span>
                        <span class="data-list">ganeshchand@gmail.com</span>
                    </div>
                    <div class="data joined">
                        <span class="data-title">Joined</span>
                        <span class="data-list">2022-02-12</span>
                        <span class="data-list">2022-02-12</span>
                        <span class="data-list">2022-02-13</span>
                        <span class="data-list">2022-02-13</span>
                        <span class="data-list">2022-02-14</span>
                        <span class="data-list">2022-02-14</span>
                        <span class="data-list">2022-02-15</span>
                    </div>
                    <div class="data type">
                        <span class="data-title">Type</span>
                        <span class="data-list">New</span>
                        <span class="data-list">Member</span>
                        <span class="data-list">Member</span>
                        <span class="data-list">New</span>
                        <span class="data-list">Member</span>
                        <span class="data-list">New</span>
                        <span class="data-list">Member</span>
                    </div>
                    <div class="data status">
                        <span class="data-title">Status</span>
                        <span class="data-list">Liked</span>
                        <span class="data-list">Liked</span>
                        <span class="data-list">Liked</span>
                        <span class="data-list">Liked</span>
                        <span class="data-list">Liked</span>
                        <span class="data-list">Liked</span>
                        <span class="data-list">Liked</span>
                    </div>
                </div>
            </div>-->
        </div>
    </section>

    <script src="js/scriptDashboard.js"></script>
</body>
</html>