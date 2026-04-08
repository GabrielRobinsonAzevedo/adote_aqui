<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../service/AnimalService.php';

class AnimalController
{
    private $service;

    public function __construct()
    {
        $conn = Database::connect();
        $repository = new AnimalRepository($conn);
        $this->service = new AnimalService($repository);
    }

    public function listar()
    {
        echo json_encode($this->service->listar());
    }

    public function cadastrar()
    {
        $dados = json_decode(file_get_contents("php://input"), true);
        echo json_encode($this->service->cadastrar($dados));
    }
}