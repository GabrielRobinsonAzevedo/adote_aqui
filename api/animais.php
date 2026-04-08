<?php

require_once __DIR__ . '/../src/controller/AnimalController.php';

header('Content-Type: application/json; charset=UTF-8');

$controller = new AnimalController();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $controller->listar();
    exit;
}

if ($method === 'POST') {
    $controller->cadastrar();
    exit;
}

http_response_code(405);
echo json_encode([
    'sucesso' => false,
    'mensagem' => 'Método não permitido.'
]);