<?php
	
	session_start();
	
	if(!isset($_SESSION['id_usuario'])){
		header("Location: dashboard.php");
	}
    $nombre_usuario = $_SESSION['nombre_usuario'];
    $perfil_id = $_SESSION['perfil_id'];
	
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <script src="https://kit.fontawesome.com/b1ab43a382.js" crossorigin="anonymous"></script>
    <title>Total Productivity</title>
    <!--Fuentes personalizadas para esta plantilla-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!--Estilos personalizados para esta plantilla-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!--Tablas de datos personalizadas CSS Basico-->
    <link href="vendor/datatables/datatable.min.css" rel="stylesheet" type="text/css"/>
    <!--Estilo de Data-Tables para CSS de bootstrap 4-->
    <link href="vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>

</head>

<body id="page-top">
    <!-- Pagina Principal -->
    <div id="wrapper">
        <!-- Barra lateral -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Barra lateral - Marca -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">TOTAL PRODUCTIVITY</div>
            </a>
        <?php if($perfil_id == 1) { ?>
            <!-- Divisor -->
            <hr class="sidebar-divider my-0">
            <!-- Elemento de navegación - Tablero de mandos -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divisor -->
            <hr class="sidebar-divider">
            <!-- Rúbrica -->
            <div class="sidebar-heading">
                Interface
            </div>
            <!-- Elemento de navegación - Utilidades Contraer menú -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseArea"
                    aria-expanded="true" aria-controls="collapseArea">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Areas</span>
                </a>
                <div id="collapseArea" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customize:</h6>
                        <a class="collapse-item" href="areasNew.php">New Areas</a>
                        <a class="collapse-item" href="areas.php">Areas</a>
                    </div>
                </div>
            </li>
            <!-- Elemento de navegación - Menú de contraer de páginas -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWC"
                    aria-expanded="true" aria-controls="collapseWC">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Work Center</span>
                </a>
                <div id="collapseWC" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customize:</h6>
                        <a class="collapse-item" href="workCenterNew.php">New Work Center</a>
                        <a class="collapse-item" href="workCenter.php">Work Center</a>
                    </div>
                </div>
            </li>
            <!-- Elemento de navegación - Utilidades contraer menú -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMP"
                    aria-expanded="true" aria-controls="collapseMP">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Raw Materials</span>
                </a>
                <div id="collapseMP" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customize:</h6>
                        <a class="collapse-item" href="rawMaterialsNew.php">New Raw Materials</a>
                        <a class="collapse-item" href="rawMaterials.php">Raw Materials</a>
                    </div>
                </div>
            </li>
            <!-- Elemento de navegación - Utilidades contraer menú -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
                    aria-expanded="true" aria-controls="collapseProduct">
                    <i class="fa-sharp fa-solid fa-box"></i>
                    <span>Product</span>
                </a>
                <div id="collapseProduct" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customize:</h6>
                        <a class="collapse-item" href="productNew.php">New Product</a>
                        <a class="collapse-item" href="product.php">Produts</a>
                    </div>
                </div>
            </li>
            <!-- Elemento de navegación - Menú de contraer de páginas -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStaff"
                    aria-expanded="true" aria-controls="collapseStaff">
                    <i class="fa-solid fa-users"></i>
                    <span>Staff</span>
                </a>
                <div id="collapseStaff" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customize:</h6>
                        <a class="collapse-item" href="#">New Staff</a>
                        <a class="collapse-item" href="staff.php">Staff</a>
                    </div>
                </div>
            </li>
            <!-- Elemento de navegación - Utilidades contraer menú -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProductionRoute"
                    aria-expanded="true" aria-controls="collapseProductionRoute">
                    <i class="fa-solid fa-route"></i>
                    <span>Production Route</span>
                </a>
                <div id="collapseProductionRoute" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customize:</h6>
                        <a class="collapse-item" href="productionRouteNew.php">New Production Route</a>
                        <a class="collapse-item" href="productionRoute.php">Production Route</a>
                    </div>
                </div>
            </li>
            <!-- Elemento de navegación - Utilidades contraer menú -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEfficiencies"
                    aria-expanded="true" aria-controls="collapseEfficiencies">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span>Efficiencies</span>
                </a>
                <div id="collapseEfficiencies" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customize:</h6>
                        <a class="collapse-item" href="efficienciesNew.php">New Efficiencies</a>
                        <a class="collapse-item" href="efficiencies.php">Efficiencies</a>
                    </div>
                </div>
            </li>
            <!-- Elemento de navegación - Utilidades contraer menú 
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProcesses"
                    aria-expanded="true" aria-controls="collapseProcesses">
                    <i class="fa-solid fa-rotate"></i>
                    <span>Processes</span>
                </a>
                <div id="collapseProcesses" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customize:</h6>
                        <a class="collapse-item" href="#">New Processes</a>
                        <a class="collapse-item" href="processes.php">Processes</a>
                    </div>
                </div>
            </li>-->
        <?php }?>
            <!-- Elemento de navegación - Utilidades Contraer menú -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProblem"
                    aria-expanded="true" aria-controls="collapseProblem">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>Problems</span>
                </a>
                <div id="collapseProblem" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Problems:</h6>
                        <a class="collapse-item" href="problemsNew.php">New problems</a>
                        <a class="collapse-item" href="problems.php">Problems</a>
                    </div>
                </div>
            </li>

            <!-- Elemento de navegación - Utilidades Contraer menú -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFormP"
                    aria-expanded="true" aria-controls="collapseFormP">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>Production Form</span>
                </a>
                <div id="collapseFormP" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customize:</h6>
                        <a class="collapse-item" href="production.php">Production Form</a>
                    </div>
                </div>
            </li>

            <!-- Elemento de navegación - Utilidades Contraer menú -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFormS"
                    aria-expanded="true" aria-controls="collapseFormS">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>Supervisors form</span>
                </a>
                <div id="collapseFormS" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customize:</h6>
                        <a class="collapse-item" href="#">Supervisors Form</a>
                    </div>
                </div>
            </li>
       
            <!-- Divisor -->
            <hr class="sidebar-divider">

            <!-- Rúbrica -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Elemento de navegación - Utilidades contraer menú -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="#">Login</a>
                        <a class="collapse-item" href="#">Register</a>
                        <a class="collapse-item" href="#">Forgot Password</a>
                    </div>
                </div>
            </li>
        
            <!-- Divisor -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Toggler de la barra lateral (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        
        </ul>
        <!-- Fin de la barra lateral -->

        <!-- Pagina de contenido -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Contenido principal -->
            <div id="content">

                <!-- Barra Superior -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Barra Lateral Superior -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Barra de navegación superior -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Elemento de navegación - Información del usuario -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nombre_usuario;?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile_2.svg">
                            </a>
                            <!-- Despliegue - Información del usuario -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- Fin de la barra superior -->