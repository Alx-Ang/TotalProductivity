<?php 
    require_once "vista/header.php"
?>
<div class="container-fluid">
    <h1><center>Work Center</center></h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
                <a href="workCenterNew.php" class="btn btn-primary">NEW</a>    
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
                                <th>MODEL</th>  
                                <th>SERIAL NUMBER</th>
                                <th>MAKER</th>
                                <th>AREA NAME</th>
                                <th>MATERIAL</th>
                                <th>STATUS</th>
                                <?php if ($_SESSION['perfil'] == 1) { ?>
                                <th>ACTIONS</th>
							    <?php } ?>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                            include "php/conexion.php";

                            $query = mysqli_query($mysqli, "SELECT workcenter.id_workcenter, workcenter.workcenter, workcenter.modelo, workcenter.numero_serie, workcenter.fabricante, areas.area_nombre, materia_prima.material, workcenter.status FROM materia_prima INNER JOIN (areas INNER JOIN workcenter ON areas.id_area = workcenter.area_nombre) ON (materia_prima.id_materiaprima = workcenter.material) AND (materia_prima.id_materiaprima = areas.material)");
                            $result = mysqli_num_rows($query);
                            if ($result > 0) {
                                while ($data = mysqli_fetch_assoc($query)) { ?>
                                    <tr>
                                        <td><?php echo $data['id_workcenter']; ?></td>
                                        <td><?php echo $data['workcenter']; ?></td> 
                                        <td><?php echo $data['modelo']; ?></td> 
                                        <td><?php echo $data['numero_serie']; ?></td> 
                                        <td><?php echo $data['fabricante']; ?></td>
                                        <td><?php echo $data['area_nombre']; ?></td>
                                        <td><?php echo $data['material']; ?></td>            
                                        <td><?php echo $data['status']; ?></td>
                                        <?php if ($_SESSION['perfil'] == 1) { ?>
                                        <td>
                                            <a href="workCenterEdit.php?id=<?php echo $data['id_workcenter']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                            <form action="#?id=<?php echo $data['id_workcenter']; ?>" method="post" class="confirmar d-inline"><button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i></button>
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