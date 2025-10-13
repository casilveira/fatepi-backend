<?php
// Definir cabeçalho para resposta JSON
header("Content-Type: application/json; charset=UTF-8");
// Simular base de dados com array
$produtos = [
    ["id" => 1, "nome" => "Mouse Gamer", "preco" => 120.00],
    ["id" => 2, "nome" => "Teclado Mecânico", "preco" => 300.00],
    ["id" => 3, "nome" => "Monitor 24", "preco" => 950.00]
 ];
 
// Capturar rota da requisição
$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);

// Roteamento básico
if ($request === "/produtos") {
    echo json_encode($produtos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} elseif (preg_match("/\/produtos\/(\d+)/", $request, $matches)) {
    $id = $matches[1];
    $produto = array_filter($produtos, fn($p) => $p["id"] == $id);
 echo json_encode(array_values($produto), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
 http_response_code(404);
 echo json_encode(["erro" => "Rota nao encontrada"]);
}
?>
