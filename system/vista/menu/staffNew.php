<?php 
    require_once "vista/header.php"
?>

<?php
    include "php/conexion.php";

    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['nombre_usuario']) || empty($_POST['nomina']) || empty($_POST['perfil']) || empty($_POST['puesto']) || empty($_POST['email']) || empty($_POST['contrasena']) || empty($_POST['status']) || empty($_POST['nombre_area'])) {
            $alert = '<center><div class="alert alert-danger" role="alert">
                           ¡ Todo los campos son obligatorios !
                      </div></center>';
        } else {
            $nombre_usuario = $_POST['nombre_usuario'];
            $nomina = $_POST['nomina'];
            $perfil = $_POST['perfil'];
            $puesto = $_POST['puesto'];
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];
            $status = $_POST['status'];
            $nombre_area = $_POST['nombre_area'];
            $perfil = $_SESSION['perfil'];
            
            $query_insert = mysqli_query($mysqli, "INSERT INTO usuarios (nombre_usuario, nomina, perfil, puesto, email,  contrasena, status, nombre_area) VALUES ('$nombre_usuario', '$nomina', '$perfil', '$puesto', '$email', '$contrasena', '$status', '$nombre_area')");
            if ($query_insert) {
                $alert = '<center> <div class="alert alert-primary" role="alert">
                            Nuevo usuario registrado
                          </div> </center>';
            } else {
                $alert = '<center><div class="alert alert-danger" role="alert">
                            ¡ Error al registrar un nuevo usuario !
                          </div></center>';
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
                <center>NEW STAFF</center>
            </div>
            <div class="card">
                <form action="" autocomplete="off" method="post" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="form-group">
                        <label for="nombre_usuario">User Name:</label>
                        <input type="text" placeholder="" name="nombre_usuario" id="nombre_usuario" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nomina">Payroll:</label>
                        <input type="text" placeholder="" name="nomina" id="nomina" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Profile:</label>
                        <div class="select">
                            <select name="perfil" id="perfil" class="form-control">
                                <option selected disabled>Select</option>
                                <option value="1">Administrator</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="puesto">Position:</label>
                        <input type="text" placeholder="" name="puesto" id="puesto" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" placeholder="" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="contrasena">Password:</label>
                        <input type="password" placeholder="" name="contrasena" id="contrasena" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status:</label>
                        <div class="select">
                            <select name="status" id="status" class="form-control">
                                <option selected disabled>Select</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombre_area">Area Name:</label>
                        <div class="select">
                            <?php
                                include "php/conexion.php";
                                $query = mysqli_query($mysqli, "SELECT *FROM areas");
                                $resultado = mysqli_num_rows($query);
                                mysqli_close($mysqli);
                                ?>
                            <select id="nombre_area" name="nombre_area" class="form-control">
                                <option selected disabled>Select</option>
                                <?php
                                if ($resultado > 0) {
                                    while ($area_nombre = mysqli_fetch_array($query)) {
                                    // code...
                                ?>
                                    <option value="<?php echo $area_nombre['id_area']; ?>"><?php echo $area_nombre['area_nombre']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <center><input type="submit" value="Save" class="btn btn-primary">
                    <a href="staff.php" class="btn btn-danger">Return</a></center>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin del contenedor principal-->

<?php
    require_once "vista/footer.php"
?>