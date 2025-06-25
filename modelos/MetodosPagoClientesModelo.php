<?php
require_once "Conexion.php";

class MetodosPagoClientesModelo {

    public static function obtenerMetodos() {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM metodospagoclientes");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function crearMetodo($datos) {
        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO metodospagoclientes 
            (id_metodopago_cliente, id_cliente, codigo_metodo_pago, numero_tarjeta, fecha_inicio, fecha_fin, otros_detalles)
            VALUES (:id_metodopago_cliente, :id_cliente, :codigo_metodo_pago, :numero_tarjeta, :fecha_inicio, :fecha_fin, :otros_detalles)"
        );

        $stmt->bindParam(":id_metodopago_cliente", $datos["id_metodopago_cliente"]);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"]);
        $stmt->bindParam(":codigo_metodo_pago", $datos["codigo_metodo_pago"]);
        $stmt->bindParam(":numero_tarjeta", $datos["numero_tarjeta"]);
        $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"]);
        $stmt->bindParam(":fecha_fin", $datos["fecha_fin"]);
        $stmt->bindParam(":otros_detalles", $datos["otros_detalles"]);

        return $stmt->execute() ? "ok" : "error";
    }

    public static function actualizarMetodo($id, $datos) {
        $stmt = Conexion::conectar()->prepare(
            "UPDATE metodospagoclientes 
             SET id_cliente = :id_cliente, codigo_metodo_pago = :codigo_metodo_pago, 
                 numero_tarjeta = :numero_tarjeta, fecha_inicio = :fecha_inicio, 
                 fecha_fin = :fecha_fin, otros_detalles = :otros_detalles 
             WHERE id_metodopago_cliente = :id"
        );

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"]);
        $stmt->bindParam(":codigo_metodo_pago", $datos["codigo_metodo_pago"]);
        $stmt->bindParam(":numero_tarjeta", $datos["numero_tarjeta"]);
        $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"]);
        $stmt->bindParam(":fecha_fin", $datos["fecha_fin"]);
        $stmt->bindParam(":otros_detalles", $datos["otros_detalles"]);

        return $stmt->execute() ? "ok" : "error";
    }

    public static function eliminarMetodo($id) {
        $stmt = Conexion::conectar()->prepare("DELETE FROM metodospagoclientes WHERE id_metodopago_cliente = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute() ? "ok" : "error";
    }
}
