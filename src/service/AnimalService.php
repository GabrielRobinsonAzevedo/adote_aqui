<?php

require_once __DIR__ . '/../repository/AnimalRepository.php';

class AnimalService
{
    private $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function cadastrar($dados)
    {
        if (empty($dados['nome']) || empty($dados['especie'])) {
            return [
                "sucesso" => false,
                "mensagem" => "Nome e espécie são obrigatórios"
            ];
        }

        if (empty($dados['numero_contato'])) {
            return [
                "sucesso" => false,
                "mensagem" => "Contato é obrigatório"
            ];
        }

        $animal = new Animal($dados);
        $this->repository->inserir($animal);

        return [
            "sucesso" => true,
            "mensagem" => "Pet cadastrado com sucesso"
        ];
    }

    public function listar()
    {
        return $this->repository->listar();
    }
}