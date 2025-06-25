<?php

require_once __DIR__ . "/../controladores/ClientesControlador.php";
require_once __DIR__ . "/../controladores/CursosControlador.php";
require_once __DIR__ . "/../controladores/MetodosPagoClientesControlador.php";
require_once __DIR__ . "/../controladores/PedidosClientesControlador.php";

if (isset($_GET["ruta"])) {

    $rutas = explode("/", $_GET["ruta"]);

    switch ($rutas[0]) {

        case "clientes":
            $clientes = new ClientesControlador();

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $clientes->index();
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $datos = json_decode(file_get_contents("php://input"), true);
                $clientes->create($datos);
            } elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
                $datos = json_decode(file_get_contents("php://input"), true);
                $clientes->update($_GET["id"], $datos);
            } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                $clientes->delete($_GET["id"]);
            } else {
                echo json_encode([
                    "status" => 405,
                    "detalle" => "Método no permitido"
                ]);
            }
            break;

        case "cursos":
            $cursos = new CursosControlador();

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $cursos->index();
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $datos = json_decode(file_get_contents("php://input"), true);
                $cursos->create($datos);
            } elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
                $datos = json_decode(file_get_contents("php://input"), true);
                $cursos->update($_GET["id"], $datos);
            } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                $cursos->delete($_GET["id"]);
            } else {
                echo json_encode([
                    "status" => 405,
                    "detalle" => "Método no permitido"
                ]);
            }
            break;

        case "metodospagoclientes":
            $metodos = new MetodosPagoClientesControlador();

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $metodos->index();
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $datos = json_decode(file_get_contents("php://input"), true);
                $metodos->create($datos);
            } elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
                $datos = json_decode(file_get_contents("php://input"), true);
                $metodos->update($_GET["id"], $datos);
            } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                $metodos->delete($_GET["id"]);
            } else {
                echo json_encode([
                    "status" => 405,
                    "detalle" => "Método no permitido"
                ]);
            }
            break;

        case "pedidosclientes":
            $pedidos = new PedidosClientesControlador();

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $pedidos->index();
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $datos = json_decode(file_get_contents("php://input"), true);
                $pedidos->create($datos);
            } elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
                $datos = json_decode(file_get_contents("php://input"), true);
                $pedidos->update($_GET["id"], $datos);
            } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                $pedidos->delete($_GET["id"]);
            } else {
                echo json_encode([
                    "status" => 405,
                    "detalle" => "Método no permitido"
                ]);
            }
            break;

        default:
            echo json_encode([
                "status" => 404,
                "detalle" => "Ruta no encontrada"
            ]);
    }

} else {
    echo json_encode([
        "status" => 404,
        "detalle" => "No se especificó ninguna ruta"
    ]);
}
