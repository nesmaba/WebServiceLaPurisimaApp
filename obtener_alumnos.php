<?php
/**
 * Obtiene todos los alumnos de la base de datos
 */

require 'Alumno.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $alumnos = Alumno::getAll();
    
    if ($alumnos) {

        $datos["estado"] = 1;
        $datos["alumnos"] = $alumnos;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}