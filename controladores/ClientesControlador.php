<?php 
require_once "modelos/ClientesModelo.php";

class ClientesControlador {

    // GET: obtener todos
    public function index() {
        $clientes = ClientesModelo::obtenerClientes();
        echo json_encode([
            "status" => 200,
            "total" => count($clientes),
            "detalle" => $clientes
        ]);
    }

    // POST: crear
    public function create($datos) {
        // Si $datos es NULL, intenta usar $_POST (caso formulario)
        if (!$datos) {
        $datos = $_POST;
        }

        // Validar campos requeridos
        if (!isset($datos["nombre"]) || !isset($datos["apellido"]) || !isset($datos["email"]) || !isset($datos["id_cliente"]) || !isset($datos["llave_secreta"])) {
        echo json_encode([
            "status" => 400,
            "detalle" => "Faltan campos requeridos"
        ]);
        return;
        }

        $respuesta = ClientesModelo::crearCliente($datos);
        echo json_encode([
            "status" => 200,
            "detalle" => $respuesta
        ]);
    }

    // PUT: actualizar
    public function update($id, $datos) {
        $respuesta = ClientesModelo::actualizarCliente($id, $datos);
        echo json_encode([
            "status" => 200,
            "detalle" => $respuesta
        ]);
    }

    // DELETE: eliminar
    public function delete($id) {
        $respuesta = ClientesModelo::eliminarCliente($id);
        echo json_encode([
            "status" => 200,
            "detalle" => $respuesta
        ]);
    }
}
