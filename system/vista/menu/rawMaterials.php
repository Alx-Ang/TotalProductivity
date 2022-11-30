<?php 
    require_once "vista/header.php"
?>

<!--Inicio del contenedor principal-->
<div class="container">
    <h1><center>RAW MATERIALS</center></h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
                <a href="rawMaterialsNew.php" class="btn btn-primary">NEW</a>    
            </div>    
        </div>    
    </div>    
   <br>  
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">        
                    <table class="table table-striped table-bordered" id="table" style="width:100%">
                        <thead class="thead-dark" >
                            <tr>
                                <th>DNI</th>
                                <th>NAME</th>
                                <th>MATERIAL</th>  
                                <th>AREA NAME</th>
                                <th>SUB-AREA</th>
                                <th>STATUS</th>
                                <?php if ($_SESSION['perfil'] == 1) { ?>
                                <th>ACTIONS</th>
							    <?php } ?>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                            include "php/conexion.php";

                            $query = mysqli_query($mysqli, "SELECT *FROM materia_prima ");
                            $result = mysqli_num_rows($query);
                            if ($result > 0) {
                                while ($data = mysqli_fetch_assoc($query)) { ?>
                                    <tr>
                                        <td><?php echo $data['id_materiaprima']; ?></td>
                                        <td><?php echo $data['nombre']; ?></td> 
                                        <td><?php echo $data['material']; ?></td> 
                                        <td><?php echo $data['area_nombre']; ?></td> 
                                        <td><?php echo $data['subarea']; ?></td> 
                                        <td><?php echo $data['status']; ?></td>
                                        <?php if ($_SESSION['perfil'] == 1) { ?>
                                        <td>
                                            <a href="rawMaterialsEdit.php?id=<?php echo $data['id_materiaprima']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                            <form action="#?id=<?php echo $data['id_materiaprima']; ?>" method="post" class="confirmar d-inline">
                                                <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
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