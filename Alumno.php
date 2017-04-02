<?php

/**
 * Representa el la estructura de las metas
 * almacenadas en la base de datos
 */
require 'Database.php';

class Alumno{
    
    function __construct(){
    }

    /**
     * Retorna en la fila especificada de la tabla 'meta'
     *
     * @param $idAlumno Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll(){
        
        $consulta = "SELECT * FROM Alumnos ORDER BY primer_apellido";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            print("hola");
            print($e);
            return false;
        }
    }

    /**
     * Obtiene los campos de una meta con un identificador
     * determinado
     *
     * @param $idAlumno Identificador del alumno
     * @return mixed
     */
    public static function getById($idAlumno){
        // Consulta de la meta
        $consulta = "SELECT idAlumno,
                            dni,
                            nombre,
                            primer_apellido,
                            segundo_apellido,
                            email,
                            telefono
                    FROM Alumnos
                    WHERE idAlumno = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idAlumno));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Obtiene los campos de una meta con un identificador
     * determinado
     *
     * @param $idCurso Identificador del curso
     * @return mixed
     */
    public static function getByCurso($idCurso){
        // Consulta de la meta
        $consulta = "SELECT idAlumno,
                            dni,
                            nombre,
                            primer_apellido,
                            segundo_apellido,
                            email,
                            telefono
                    FROM Alumnos
                    WHERE idCurso = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idCurso));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta JSON
            return -1;
        }
    }

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idAlumno      identificador del alumno
     * @param $dni      dni del alumno
     * @param $nombre nombre del alumno
     * @param $primer_apellido    primer apellido
     * @param $segundo_apellido   segundo apellido
     * @param $email   correo electrónico
     * @param $telefono     telefonp
     */
    public static function update(
        $idAlumno,
        $dni,
        $nombre,
        $primer_apellido,
        $segundo_apellido,
        $email,
        $telefono){
        // Creando consulta UPDATE
        $consulta = "UPDATE Alumnos" .
            " SET dni=?, nombre=?, primer_apellido=?, segundo_apellido=?, email=?, telefono=?" .
            "WHERE idAlumno=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($dni, $nombre, $primer_apellido, $segundo_apellido, $email, $telefono, $idMeta));

        return $cmd;
    }

    /**
     * Insertar una nueva meta
     *
     * @param $idAlumno      identificador del alumno
     * @param $dni      dni del alumno
     * @param $nombre nombre del alumno
     * @param $primer_apellido    primer apellido
     * @param $segundo_apellido   segundo apellido
     * @param $email   correo electrónico
     * @param $telefono     telefonp
     * @return PDOStatement
     */
    public static function insert(
        $idAlumno,
        $dni,
        $nombre,
        $primer_apellido,
        $segundo_apellido,
        $email,
        $telefono){
        
        // Sentencia INSERT
        $comando = "INSERT INTO Alumnos( " .
            "dni," .
            " nombre," .
            " primer_apellido," .
            " segundo_apellido," .
            " email," .
            " telefono)" .
            " VALUES( ?,?,?,?,?,? )";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $idAlumno,
                $dni,
                $nombre,
                $primer_apellido,
                $segundo_apellido,
                $email,
                $telefono
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idAlumno identificador de la meta
     * @return bool Respuesta de la eliminación
     */
    public static function delete($idAlumno)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM Alumnos WHERE idAlumno=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idAlumno));
    }
}

