<?php 
    require_once "vista/header.php"
?>

<?php
    include "php/conexion.php";

    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['codigo_producto']) || empty($_POST['codigo_sistema']) || empty($_POST['descripcion']) || empty($_POST['nombre_area']) || empty($_POST['observaciones']) || empty($_POST['ciclo_meta']) || empty($_POST['status'])) {
            $alert = '<center><div class="alert alert-danger" role="alert">
                        ¡ Todo los campos son obligatorios !
                      </div></center>';
        } else {
            $codigo_producto = $_POST['codigo_producto'];
            $codigo_sistema = $_POST['codigo_sistema'];
            $descripcion = $_POST['descripcion'];
            $nombre_area = $_POST['nombre_area'];
            $observaciones = $_POST['observaciones'];
            $ciclo_meta = $_POST['ciclo_meta'];
            $status = $_POST['status'];
            $perfil = $_SESSION['perfil'];

            $query = mysqli_query($mysqli, "SELECT * FROM producto WHERE codigo_producto = '$codigo_producto'");
            $result = mysqli_fetch_array($query);

            if ($result > 0) {
                $alert = '<div class="alert alert-danger" role="alert">
                            ¡ El codigo del producto ya ha sido registrado !
                        </div>';
            }else{
            
            $query_insert = mysqli_query($mysqli, "INSERT INTO producto (codigo_producto, codigo_sistema, descripcion, nombre_area, observaciones,  ciclo_meta, status) VALUES ('$codigo_producto', '$codigo_sistema', '$descripcion', '$nombre_area', '$observaciones', '$ciclo_meta', '$status')");
            if ($query_insert) {
                $alert = '<center><div class="alert alert-primary" role="alert">
                            Nuevo producto registrado
                        </div></center>';
            } else {
                $alert = '<center><div class="alert alert-danger" role="alert">
                            ¡ Error al registrar un nuevo producto !
                          </div></center>';
            }
            }
        }
    }
    mysqli_close($mysqli);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card-header bg-primary text-white">
                <center>NEW PRODUCT</center>
            </div>
            <div class="card">
                <form action="" autocomplete="off" method="post" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="form-group">
                        <label for="codigo_producto">Product Code:</label>
                        <input type="text" placeholder="" name="codigo_producto" id="codigo_producto" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="codigo_sistema">System Code:</label>
                        <input type="text" placeholder="" name="codigo_sistema" id="codigo_sistema" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Description:</label>
                        <input type="text" placeholder="" name="descripcion" id="descripcion" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nombre_area">Area Name:</label>
                        <div>
                            <?php
                                include "php/conexion.php";
                                $query = mysqli_query($mysqli, "SELECT id_area, area_nombre FROM areas");
                                $result = mysqli_num_rows($query);
                                mysqli_close($mysqli);
                                
                            ?>
                            <select id="nombre_area" name="nombre_area" class="form-control">
                                    <option value="">Select</option>
                                <?php
                                if ($result > 0) {
                                    while ($area_nombre = mysqli_fetch_array($query)) {
                                    
                                ?>
                                    <option value="<?php echo $area_nombre['id_area']; ?>"><?php echo $area_nombre['area_nombre']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="observaciones">Observations:</label>
                        <input type="text" placeholder="" name="observaciones" id="observaciones" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ciclo_meta">Target Cycle:</label>
                        <input type="text" placeholder="" name="ciclo_meta" id="ciclo_meta" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status:</label>
                        <div class="select">
                            <select name="status" id="status" class="form-control">
                                <option selected disabled>Select</option>
                                <option value="Activo">Active</option>
                                <option value="Inactivo">Inactive</option>
                            </select>
                        </div>
                    </div>
                    

                    <center><input type="submit" value="Save" class="btn btn-primary">
                    <a href="product.php" class="btn btn-danger">Return</a></center>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin del contenedor principal-->

<?php
    require_once "vista/footer.php"
?>