<?php

require_once __DIR__ . '/../model/Animal.php';
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
        if (empty($dados['nome'])) {
            return [
                'sucesso' => false,
                'mensagem' => 'O nome do pet é obrigatório.'
            ];
        }

        if (empty($dados['sexo'])) {
            return [
                'sucesso' => false,
                'mensagem' => 'O sexo do pet é obrigatório.'
            ];
        }

        if (empty($dados['especie'])) {
            return [
                'sucesso' => false,
                'mensagem' => 'A espécie do pet é obrigatória.'
            ];
        }

        if (empty($dados['numero_contato'])) {
            return [
                'sucesso' => false,
                'mensagem' => 'O número de contato é obrigatório.'
            ];
        }

        $animal = new Animal($dados);
        $resultado = $this->repository->inserir($animal);

        if ($resultado) {
            return [
                'sucesso' => true,
                'mensagem' => 'Pet cadastrado com sucesso.'
            ];
        }

        return [
            'sucesso' => false,
            'mensagem' => 'Erro ao cadastrar o pet.'
        ];
    }

    public function listar()
    {
        return $this->repository->listar();
    }

    public function buscarPorId($id)
    {
        $animal = $this->repository->buscarPorId($id);

        if (!$animal) {
            return [
                'sucesso' => false,
                'mensagem' => 'Animal não encontrado.'
            ];
        }

        return $animal;
    }
}