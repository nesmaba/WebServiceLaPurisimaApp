<?php

/**
 * Representa el la estructura de las metas
 * almacenadas en la base de datos
 */
require 'Database.php';

class Curso{
    
    function __construct(){
    }

    /**
     * Retorna en la fila especificada de la tabla 'meta'
     *
     * @param $idCurso Identificador del curso
     * @return array Datos del registro
     */
    public static function getAll(){
        
        $consulta = "SELECT * FROM Cursos ORDER BY curso";
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
     * @param $idCurso Identificador del curso
     * @return mixed
     */
    public static function getById($idCurso){
        // Consulta de la meta
        $consulta = "SELECT idCurso,
                            curso,
                            etapa,
                            grupo
                    FROM Cursos
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
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idCurso      identificador del curso
     * @param $curso      número del curso: 1, 2, 3, 4
     * @param $etapa nombre de la etapa: ESO, Bachillerato
     * @param $grupo    letra del grupo: A, B, C, D
     */
    public static function update(
        $curso,
        $etapa,
        $grupo){
        // Creando consulta UPDATE
        $consulta = "UPDATE Cursos" .
            " SET curso=?, etapa=?, grupo=?" .
            "WHERE idCurso=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($dni, $nombre, $primer_apellido, $segundo_apellido, $email, $telefono, $idMeta));

        return $cmd;
    }

    /**
     * Insertar una nueva meta
     *
     * @param $idCurso      identificador del curso
     * @param $curso      número del curso: 1, 2, 3, 4
     * @param $etapa nombre de la etapa: ESO, Bachillerato
     * @param $grupo    letra del grupo: A, B, C, D
     * @return PDOStatement
     */
    public static function insert(
        $idCurso,
        $dni,
        $nombre,
        $primer_apellido,
        $segundo_apellido,
        $email,
        $telefono){
        
        // Sentencia INSERT
        $comando = "INSERT INTO Cursos( " .
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
                $idCurso,
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
     * @param $idCurso identificador de la meta
     * @return bool Respuesta de la eliminación
     */
    public static function delete($idCurso)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM Cursos WHERE idCurso=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idCurso));
    }
}

