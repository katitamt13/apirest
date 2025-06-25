<?php
require_once "modelos/CursosModelo.php";

class CursosControlador {

    // GET: obtener cursos
    public function index() {
        $cursos = CursosModelo::obtenerCursos();
        echo json_encode([
            "status" => 200,
            "total" => count($cursos),
            "detalle" => $cursos
        ]);
    }

    // POST: crear curso
    public function create($datos) {
        if (!$datos) {
            $datos = $_POST;
        }

        if (!isset($datos["titulo"]) || !isset($datos["descripcion"]) || !isset($datos["instructor"]) || !isset($datos["imagen"]) || !isset($datos["precio"]) || !isset($datos["id_creador"])) {
            echo json_encode([
                "status" => 400,
                "detalle" => "Faltan campos requeridos"
            ]);
            return;
        }

        $respuesta = CursosModelo::crearCurso($datos);

        echo json_encode([
            "status" => 200,
            "detalle" => $respuesta
        ]);
    }

    // PUT: actualizar curso
    public function update($id, $datos) {
        if (!$datos) {
            parse_str(file_get_contents("php://input"), $datos);
        }

        if (!isset($datos["titulo"]) || !isset($datos["descripcion"]) || !isset($datos["instructor"]) || !isset($datos["imagen"]) || !isset($datos["precio"])) {
            echo json_encode([
                "status" => 400,
                "detalle" => "Faltan campos requeridos"
            ]);
            return;
        }

        $respuesta = CursosModelo::actualizarCurso($id, $datos);

        echo json_encode([
            "status" => 200,
            "detalle" => $respuesta
        ]);
    }

    // DELETE: eliminar curso
    public function delete($id) {
        $respuesta = CursosModelo::eliminarCurso($id);
        echo json_encode([
            "status" => 200,
            "detalle" => $respuesta
        ]);
    }
}
