<?php

require_once __DIR__ . '/../src/controller/AnimalController.php';

header('Content-Type: application/json');

$controller = new AnimalController();

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode([
        "sucesso" => false,
        "mensagem" => "ID não informado"
    ]);
    exit;
}

echo json_encode($controller->service->buscarPorId($id));