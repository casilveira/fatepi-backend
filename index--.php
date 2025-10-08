<?php
header("Content-Type: application/json; charset=UTF-8");

// Simulando dados (poderia ser de um banco)
$usuarios = [
    ["id" => 1, "nome" => "Carlos"],
    ["id" => 2, "nome" => "Ana"],
];
// Detecta o método HTTP
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        echo json_encode($usuarios);
        break;
    default:
        http_response_code(405);
        echo json_encode(["erro" => "Método não permitido"]);
        break;
}
?>
