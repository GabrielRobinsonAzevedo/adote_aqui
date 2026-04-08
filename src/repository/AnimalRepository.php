<?php

require_once __DIR__ . '/../model/Animal.php';

class AnimalRepository
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function inserir(Animal $animal)
    {
        $sql = "INSERT INTO animal 
        (nome, sexo, especie, idade, descricao, numero_contato, foto, castrado, vacinado)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $animal->nome,
            $animal->sexo,
            $animal->especie,
            $animal->idade,
            $animal->descricao,
            $animal->numero_contato,
            $animal->foto,
            $animal->castrado,
            $animal->vacinado
        ]);
    }

    public function listar()
    {
        $stmt = $this->conn->query("SELECT * FROM animal ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}