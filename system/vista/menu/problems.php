<?php 
    require_once "vista/header.php"
?>

<!--Inicio del contenedor principal-->
<div class="container">
    <h1><center>Problems</center></h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
                <a href="problemsNew.php" class="btn btn-primary">New</a>    
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
                                <th>Id</th>
                                <th>Problem Name</th>
                                <th>Description</th>
                                <th>Area Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                            include "php/conexion.php";

                            $query = mysqli_query($mysqli, "SELECT * FROM problemas");
                            $result = mysqli_num_rows($query);
                            if ($result > 0) {
                                while ($data = mysqli_fetch_assoc($query)) { ?>
                                    <tr>
                                        <td><?php echo $data['id_problema']; ?></td>
                                        <td><?php echo $data['nombre_problema']; ?></td> 
                                        <td><?php echo $data['descripcion']; ?></td> 
                                        <td><?php echo $data['nombre_area']; ?></td>      
                                        <td><?php echo $data['status']; ?></td>
                                        
                                        <td>
                                            <a href="problemEdit.php?id=<?php echo $data['id_problema']; ?>" class="btn btn-success"><i class="fa-solid fa-file-pen"></i></a>
                                            <form action="#?id=<?php echo $data['id_problema']; ?>" method="post" class="confirmar d-inline"><button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i></button>
                                            </form>
                                        </td>
                                        
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