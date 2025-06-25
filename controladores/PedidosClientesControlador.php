<?php
require_once "modelos/PedidosClientesModelo.php";

class PedidosClientesControlador {

    public function index() {
        $pedidos = PedidosClientesModelo::obtenerPedidos();
        echo json_encode([
            "status" => 200,
            "total" => count($pedidos),
            "detalle" => $pedidos
        ]);
    }

    public function create($datos) {
        if (!$datos) $datos = $_POST;

        $respuesta = PedidosClientesModelo::crearPedido($datos);
        echo json_encode(["status" => 200, "detalle" => $respuesta]);
    }

    public function update($id, $datos) {
        if (!$datos) parse_str(file_get_contents("php://input"), $datos);

        $respuesta = PedidosClientesModelo::actualizarPedido($id, $datos);
        echo json_encode(["status" => 200, "detalle" => $respuesta]);
    }

    public function delete($id) {
        $respuesta = PedidosClientesModelo::eliminarPedido($id);
        echo json_encode(["status" => 200, "detalle" => $respuesta]);
    }
}

