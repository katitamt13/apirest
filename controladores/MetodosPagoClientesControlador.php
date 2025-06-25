<?php
require_once "modelos/MetodosPagoClientesModelo.php";

class MetodosPagoClientesControlador {

    public function index() {
        $metodos = MetodosPagoClientesModelo::obtenerMetodos();
        echo json_encode([
            "status" => 200,
            "total" => count($metodos),
            "detalle" => $metodos
        ]);
    }

    public function create($datos) {
        if (!$datos) $datos = $_POST;

        $respuesta = MetodosPagoClientesModelo::crearMetodo($datos);
        echo json_encode(["status" => 200, "detalle" => $respuesta]);
    }

    public function update($id, $datos) {
        if (!$datos) parse_str(file_get_contents("php://input"), $datos);

        $respuesta = MetodosPagoClientesModelo::actualizarMetodo($id, $datos);
        echo json_encode(["status" => 200, "detalle" => $respuesta]);
    }

    public function delete($id) {
        $respuesta = MetodosPagoClientesModelo::eliminarMetodo($id);
        echo json_encode(["status" => 200, "detalle" => $respuesta]);
    }
}
