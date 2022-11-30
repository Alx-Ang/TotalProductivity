<?php 
    require_once "vista/header.php"
?>

<!--Inicio del contenedor principal-->
<div class="container">
    <h1><center>EFFICIENCIES</center></h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
                <a href="efficienciesNew.php" class="btn btn-primary">NEW</a>    
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
                                <th>CODE PRODUCT</th>
                                <th>DESCRIPTION</th>
                                <th>PRODUC ROUTE</th>
                                <th>AREA NAME</th>
                                <th>CYCLE META</th>
                                <th>HOUR META</th>
                                <th>STATUS</th>
                                <?php if ($_SESSION['perfil'] == 1) { ?>
                                <th>ACTIONS</th>
							    <?php } ?>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                            include "php/conexion.php";

                            $query = mysqli_query($mysqli, "SELECT *FROM eficiencias e, producto p WHERE p.id_producto = e.codigo_producto");
                            $result = mysqli_num_rows($query);
                            if ($result > 0) {
                                while ($data = mysqli_fetch_assoc($query)) { ?>
                                    <tr>
                                        <td><?php echo $data['id_eficiencias']; ?></td>
                                        <td><?php echo $data['codigo_producto']; ?></td> 
                                        <td><?php echo $data['descripcion']; ?></td> 
                                        <td><?php echo $data['ruta_produccion']; ?></td> 
                                        <td><?php echo $data['nombre_area']; ?></td>
                                        <td><?php echo $data['ciclo_meta']; ?></td>
                                        <td><?php echo $data['meta_hora']; ?></td>       
                                        <td><?php echo $data['status']; ?></td>
                                        <?php if ($_SESSION['perfil'] == 1) { ?>
                                        <td>
                                            <a href="efficienciesEdit.php?id=<?php echo $data['id_eficiencias']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                            <form action="#?id=<?php echo $data['id_eficiencias']; ?>" method="post" class="confirmar d-inline"><button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i></button>
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