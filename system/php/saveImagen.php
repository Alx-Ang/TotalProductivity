<?php

    include 'conexion.php';

    $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

    $query = "INSERT INTO areas (imagen) VALUES ('$imagen')";
    $result = $mysqli -> query ($query);

    if($result){
       echo "Imagen insertada";
    }else{
        echo "Imagen no insertada";
    }
?>