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
        $sql = "INSERT INTO animal (
                    nome,
                    sexo,
                    especie,
                    data_nascimento,
                    porte,
                    peso_atual,
                    cor_pelagem,
                    raca,
                    descricao,
                    numero_contato,
                    foto,
                    castrado,
                    vacinado
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $animal->nome,
            $animal->sexo,
            $animal->especie,
            $animal->data_nascimento ?: null,
            $animal->porte,
            $animal->peso_atual !== '' ? $animal->peso_atual : null,
            $animal->cor_pelagem,
            $animal->raca,
            $animal->descricao,
            $animal->numero_contato,
            $animal->foto,
            $animal->castrado ? 1 : 0,
            $animal->vacinado ? 1 : 0
        ]);
    }

    public function listar()
    {
        $stmt = $this->conn->query("SELECT * FROM animal ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM animal WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}