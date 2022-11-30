<?php 
    require_once "vista/header.php"
?>

<!--Inicio del contenedor principal-->
<div class="container">
    <h1><center>STAFF</center></h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
                <a href="staffNew.php" class="btn btn-primary">NEW</a>    
            </div>    
        </div>    
    </div>    
   <br>  
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">        
                    <table class="table table-striped table-bordered" id="table">
                        <thead class="thead-dark" >
                            <tr>
                                <th>DNI</th>
                                <th>USER NAME</th>
                                <th>PAYROLL</th>  
                                <th>POSITION</th>
                                <th>EMAIL</th>      
                                <th>STATUS</th>
                                <th>PROFILE</th>
                                <th>AREA NAME</th>
                                <?php if ($_SESSION['perfil'] == 1) { ?>
                                <th>ACTIONS</th>
							    <?php } ?>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                            include "php/conexion.php";

                            $query = mysqli_query($mysqli, "SELECT usuarios.id_usuario, usuarios.nombre_usuario, usuarios.nomina, usuarios.puesto, usuarios.email, usuarios.contrasena, usuarios.status, perfiles.rol, areas.area_nombre FROM perfiles INNER JOIN (areas INNER JOIN usuarios ON areas.id_area = usuarios.nombre_area) ON perfiles.id_perfil = usuarios.perfil");
                            
                            $result = mysqli_num_rows($query);
                            if ($result > 0) {
                                while ($data = mysqli_fetch_assoc($query)) { ?>
                                    <tr>
                                        <td><?php echo $data['id_usuario']; ?></td>
                                        <td><?php echo $data['nombre_usuario']; ?></td> 
                                        <td><?php echo $data['nomina']; ?></td> 
                                        <td><?php echo $data['puesto']; ?></td>
                                        <td><?php echo $data['email']; ?></td>                                        
                                        <td><?php echo $data['status']; ?></td>
                                        <td><?php echo $data['rol']; ?></td> 
                                        <td><?php echo $data['area_nombre']; ?></td>
                                        <?php if ($_SESSION['perfil'] == 1) { ?>
                                        <td>
                                            <a href="staffEdit.php?id=<?php echo $data['id_usuario']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                            <form action="#?id=<?php echo $data['id_usuario']; ?>" method="post" class="confirmar d-inline"><button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i></button>
                                            </form>
                                        </td>
                                        <?php } ?>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div>  
    </div>        
</div>
<!--Fin del contenedor principal-->

<?php
    require_once "vista/footer.php"
?>