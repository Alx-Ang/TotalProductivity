<?php
if (!empty($_GET['id'])) {
    require("php/conexion.php");
    $id = $_GET['id'];
    $query_delete = mysqli_query($mysqli, "DELETE FROM workcenter WHERE id_workcenter = $id");
    mysqli_close($mysqli);
    header("location: workCenter.php");
}
?>
