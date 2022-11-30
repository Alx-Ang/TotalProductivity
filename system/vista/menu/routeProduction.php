<?php 
    require_once "vista/header.php"
?>

<!--Inicio del contenedor principal-->
<div class="container">
    <h1><center>PRODUCTION ROUTE</center></h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
                <a href="productionRouteNew.php" class="btn btn-primary">NEW</a>    
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
                                <th>WORK CENTER</th>
                                <th>OBSERVATION</th>
                                <th>TARGET PER HOUR</th>
                                <th>STATUS CYCLE</th>
                                <th>DATE</th>
                                <th>STATUS</th>
                                <?php if ($_SESSION['perfil'] == 1) { ?>
                                <th>ACTIONS</th>
							    <?php } ?>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                            include "php/conexion.php";

                            $query = mysqli_query($mysqli, "SELECT ruta_produccion.id_rutaproduccion, workcenter.workcenter, ruta_produccion.observaciones, ruta_produccion.meta_hora, ruta_produccion.ciclo_estado, ruta_produccion.fecha_hora, ruta_produccion.status FROM workcenter INNER JOIN ruta_produccion ON workcenter.id_workcenter = ruta_produccion.workcenter");
                            $result = mysqli_num_rows($query);
                            if ($result > 0) {
                                while ($data = mysqli_fetch_assoc($query)) { ?>
                                    <tr>
                                        <td><?php echo $data['id_rutaproduccion']; ?></td>
                                        <td><?php echo $data['workcenter']; ?></td> 
                                        <td><?php echo $data['observaciones']; ?></td> 
                                        <td><?php echo $data['meta_hora']; ?></td> 
                                        <td><?php echo $data['ciclo_estado']; ?></td>
                                        <td><?php echo $data['fecha_hora']; ?></td>       
                                        <td><?php echo $data['status']; ?></td>
                                        <?php if ($_SESSION['perfil'] == 1) { ?>
                                        <td>
                                            <a href="productionRouteEdit.php?id=<?php echo $data['id_rutaproduccion']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                            <form action="#?id=<?php echo $data['id_rutaproduccion']; ?>" method="post" class="confirmar d-inline"><button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i></button>
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