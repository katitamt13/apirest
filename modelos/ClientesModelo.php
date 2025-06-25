<?php
require_once "Conexion.php";

class ClientesModelo {

    // READ: obtener todos los clientes
    static public function obtenerClientes() {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM clientes");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // CREATE: insertar un cliente
    static public function crearCliente($datos) {
        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO clientes (nombre, apellido, email, id_cliente, llave_secreta, created_at, updated_at) 
            VALUES (:nombre, :apellido, :email, :id_cliente, :llave_secreta, NOW(), NOW())"
        );
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":llave_secreta", $datos["llave_secreta"], PDO::PARAM_STR);

        return $stmt->execute() ? "ok" : "error";
    }

    // UPDATE: actualizar un cliente
    static public function actualizarCliente($id, $datos) {
        $stmt = Conexion::conectar()->prepare(
            "UPDATE clientes 
             SET nombre = :nombre, apellido = :apellido, email = :email, updated_at = NOW() 
             WHERE id = :id"
        );
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute() ? "ok" : "error";
    }

    // DELETE: eliminar un cliente
    static public function eliminarCliente($id) {
        $stmt = Conexion::conectar()->prepare(
            "DELETE FROM clientes WHERE id = :id"
        );
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute() ? "ok" : "error";
    }
}
