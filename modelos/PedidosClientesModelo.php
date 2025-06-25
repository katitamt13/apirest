<?php
require_once "Conexion.php";

class PedidosClientesModelo {

    public static function obtenerPedidos() {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM pedidosclientes");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function crearPedido($datos) {
        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO pedidosclientes 
            (id_pedido, id_cliente, id_metodopago_cliente, codigo_estado_pedido, fecha_pedido, fecha_pago, precio_total_pedido, otros_detalles_pedido)
            VALUES (:id_pedido, :id_cliente, :id_metodopago_cliente, :codigo_estado_pedido, :fecha_pedido, :fecha_pago, :precio_total_pedido, :otros_detalles_pedido)"
        );

        $stmt->bindParam(":id_pedido", $datos["id_pedido"]);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"]);
        $stmt->bindParam(":id_metodopago_cliente", $datos["id_metodopago_cliente"]);
        $stmt->bindParam(":codigo_estado_pedido", $datos["codigo_estado_pedido"]);
        $stmt->bindParam(":fecha_pedido", $datos["fecha_pedido"]);
        $stmt->bindParam(":fecha_pago", $datos["fecha_pago"]);
        $stmt->bindParam(":precio_total_pedido", $datos["precio_total_pedido"]);
        $stmt->bindParam(":otros_detalles_pedido", $datos["otros_detalles_pedido"]);

        return $stmt->execute() ? "ok" : "error";
    }

    public static function actualizarPedido($id, $datos) {
        $stmt = Conexion::conectar()->prepare(
            "UPDATE pedidosclientes 
             SET id_cliente = :id_cliente, id_metodopago_cliente = :id_metodopago_cliente,
                 codigo_estado_pedido = :codigo_estado_pedido, fecha_pedido = :fecha_pedido,
                 fecha_pago = :fecha_pago, precio_total_pedido = :precio_total_pedido,
                 otros_detalles_pedido = :otros_detalles_pedido
             WHERE id_pedido = :id"
        );

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"]);
        $stmt->bindParam(":id_metodopago_cliente", $datos["id_metodopago_cliente"]);
        $stmt->bindParam(":codigo_estado_pedido", $datos["codigo_estado_pedido"]);
        $stmt->bindParam(":fecha_pedido", $datos["fecha_pedido"]);
        $stmt->bindParam(":fecha_pago", $datos["fecha_pago"]);
        $stmt->bindParam(":precio_total_pedido", $datos["precio_total_pedido"]);
        $stmt->bindParam(":otros_detalles_pedido", $datos["otros_detalles_pedido"]);

        return $stmt->execute() ? "ok" : "error";
    }

    public static function eliminarPedido($id) {
        $stmt = Conexion::conectar()->prepare("DELETE FROM pedidosclientes WHERE id_pedido = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute() ? "ok" : "error";
    }
}
