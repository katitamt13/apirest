<?php
require_once "Conexion.php";

class CursosModelo {

    // READ: obtener todos los cursos
    static public function obtenerCursos() {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM cursos");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // CREATE: insertar curso
    static public function crearCurso($datos) {
        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO cursos (titulo, descripcion, instructor, imagen, precio, id_creador, created_at, updated_at)
            VALUES (:titulo, :descripcion, :instructor, :imagen, :precio, :id_creador, NOW(), NOW())"
        );
        $stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":instructor", $datos["instructor"], PDO::PARAM_STR);
        $stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"]);
        $stmt->bindParam(":id_creador", $datos["id_creador"], PDO::PARAM_INT);

        return $stmt->execute() ? "ok" : "error";
    }

    // UPDATE: actualizar curso
    static public function actualizarCurso($id, $datos) {
        $stmt = Conexion::conectar()->prepare(
            "UPDATE cursos 
             SET titulo = :titulo, descripcion = :descripcion, instructor = :instructor, imagen = :imagen, precio = :precio, updated_at = NOW()
             WHERE id = :id"
        );
        $stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":instructor", $datos["instructor"], PDO::PARAM_STR);
        $stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"]);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute() ? "ok" : "error";
    }

    // DELETE: eliminar curso
    static public function eliminarCurso($id) {
        $stmt = Conexion::conectar()->prepare(
            "DELETE FROM cursos WHERE id = :id"
        );
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute() ? "ok" : "error";
    }
}
