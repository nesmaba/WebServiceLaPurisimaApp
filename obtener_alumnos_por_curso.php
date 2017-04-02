<?php
/**
 * Obtiene todos los alumnos de la base de datos
 */

require 'Alumno.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idCurso'])) {
        // Obtener parámetro idMeta
        $idCurso = $_GET['idCurso'];
        // Manejar petición GET
        $alumnos = Alumno::getByCurso($idCurso);
        
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
    } else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador del curso'
            )
        );
    }
}