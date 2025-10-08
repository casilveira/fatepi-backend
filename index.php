<?php
header("Content-Type: application/json; charset=UTF-8");

// Função para verificar status
function verificarStatusAluno($media) {
    if ($media >= 7) {
        return "Aprovado";
    } elseif ($media >= 4) {
        return "Prova Final";
    } else {
        return "Reprovado";
    }
}

// "Banco de dados" simulado
$usuarios = [
    ["id" => 1, "nome" => "Carlos", "media" => 5],
    ["id" => 2, "nome" => "Ana", "media" => 8],
    ["id" => 3, "nome" => "João", "media" => 3]
];

// Adiciona o status a cada aluno
foreach ($usuarios as &$usuario) {
    $usuario["status"] = verificarStatusAluno($usuario["media"]);
}

// Captura a URL requisitada
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Rotas
if ($request === "/usuarios") {
    echo json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

} elseif (preg_match("/\/usuarios\/(\d+)/", $request, $matches)) {
    $id = $matches[1];
    $usuario = array_filter($usuarios, fn($u) => $u['id'] == $id);

    if (!empty($usuario)) {
        echo json_encode(array_values($usuario), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(404);
        echo json_encode(["erro" => "Usuário não encontrado"]);
    }

} else {
    http_response_code(404);
    echo json_encode(["erro" => "Rota não encontrada"]);
}
?>