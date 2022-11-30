<?php
    include "vista/header.php";
?>

<?php
    include "php/conexion.php";
    
    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['nombre_usuario']) || empty($_POST['nomina']) || empty($_POST['perfil']) || empty($_POST['puesto']) || empty($_POST['email']) || empty($_POST['contrasena']) || empty($_POST['status']) || empty($_POST['nombre_area'])) {
            $alert = '<center><p class"msg_error" class="alert alert-danger" role="alert">
                        ¡ Todo los campos son requeridos ! </p></center>';
        } else {
            $id_usuario = $_GET['id'];
            $nombre_usuario = $_POST['nombre_usuario'];
            $nomina = $_POST['nomina'];
            $perfil = $_POST['perfil'];
            $puesto = $_POST['puesto'];
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];
            $status = $_POST['status'];
            $nombre_area = $_POST['nombre_area'];

            $sql_update = mysqli_query($mysqli, "UPDATE usuarios SET nombre_usuario = '$nombre_usuario', nomina = '$nomina', perfil = '$perfil', puesto = '$puesto', email = '$email', contrasena = '$contrasena', status = '$status', nombre_area = '$nombre_area' WHERE id_usuario = '$id_usuario'");

            if ($sql_update) {
                $alert = '<center> <p class"msg_save" class="alert alert-primary" role="alert">
                            Cambios actualizado correctamente </p> </center>';
            } else {
                $alert = '<center> <p class"msg_error class="alert alert-danger" role="alert">
                           ¡ Error al actualizar los cambios ! </p> </center>';
            }
        }
    }
    
    // Mostrar Datos

    if (empty($_REQUEST['id'])) {
        header("location: staff.php");
        mysqli_close($mysqli);
        }
    
        $id_usuario = $_REQUEST['id'];
        $query = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE id_usuario = $id_usuario");
        mysqli_close($mysqli);
        $result_sql = mysqli_num_rows($query);
    
        if ($result_sql == 0) {
        header("location: staff.php");
        } else {
            while ($data = mysqli_fetch_array($query)) {
                $id_usuario = $data['id_usuario'];
                $nombre_usuario = $data['nombre_usuario'];
                $nomina = $data['nomina'];
                $perfil = $data['perfil'];
                $puesto = $data['puesto'];
                $email = $data['email'];
                $contrasena = $data['contrasena'];
                $status = $data['status'];
                $nombre_area = $data['nombre_area'];
            }
        }
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card-header bg-primary text-white">
                <center>EDIT USER</center>
            </div>
            <div class="card">
                <form action="" method="post" autocomplete="off" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <input type="hidden" name="id" value="<?php echo $id_usuario; ?>">
                        <div class="form-group">
                            <label for="nombre_usuario">User Name:</label>
                            <input type="text" placeholder="" name="nombre_usuario" id="nombre_usuario" class="form-control" value="<?php echo $nombre_usuario; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nomina">Payroll:</label>
                            <input type="text" placeholder="" name="nomina" id="nomina" class="form-control" value="<?php echo $nomina; ?>">
                        </div>
                        <div class="form-group">
                            <label>Profile:</label>
                            <div class="select">
                                <select name="perfil" id="perfil" class="form-control" value="<?php echo $perfil; ?>" >
                                <option ><?php echo $perfil; ?></option>
                                    <option value="1">Administrator</option>
                                    <option value="2">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="puesto">Position:</label>
                            <input type="text" placeholder="" name="puesto" id="puesto" class="form-control" value="<?php echo $puesto; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" placeholder="" name="email" id="email" class="form-control" value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group">
                            <label for="contrasena">Password:</label>
                            <input type="text" placeholder="" name="contrasena" id="contrasena" class="form-control" value="<?php echo $contrasena; ?>">
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <div class="select">
                                <select name="status" id="status" class="form-control" value="<?php echo $status; ?>">
                                    <option value="Activo">Active</option>
                                    <option value="Inactivo">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nombre_area">Area Name:</label>
                            <div class="select">
                                <?php
                                    include "php/conexion.php";
                                    $query = mysqli_query($mysqli, "SELECT id_area, area_nombre FROM areas");
                                    $result = mysqli_num_rows($query);
                                    mysqli_close($mysqli);
                                    
                                ?>
                                <select id="nombre_area" name="nombre_area" class="form-control">
                                        <option value=""><?php echo $nombre_area; ?></option>
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


                    <center></Canvas><input type="submit" value="Save Change" class="btn btn-primary">
                        <a href="staff.php" class="btn btn-danger">Return</a></center>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End of Main Content -->
<?php include_once "vista/footer.php"; ?>