<?php

require_once __DIR__ . '/../src/controller/AnimalController.php';

header('Content-Type: application/json');

$controller = new AnimalController();

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $controller->listar();
} elseif ($method === 'POST') {
    $controller->cadastrar();
}