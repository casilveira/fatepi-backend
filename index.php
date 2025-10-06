<?php
header("Content-Type: application/json; charset=UTF-8");
$usuarios = [
["id" => 1, "nome" => "Carlos"],
["id" => 2, "nome" => "Ana"],
];
echo json_encode($usuarios);
?>
