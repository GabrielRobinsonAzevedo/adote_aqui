<?php

class Animal
{
    public $id;
    public $nome;
    public $sexo;
    public $especie;
    public $idade;
    public $descricao;
    public $numero_contato;
    public $foto;
    public $castrado;
    public $vacinado;

    public function __construct($dados)
    {
        $this->nome = $dados['nome'] ?? '';
        $this->sexo = $dados['sexo'] ?? '';
        $this->especie = $dados['especie'] ?? '';
        $this->idade = $dados['idade'] ?? 0;
        $this->descricao = $dados['descricao'] ?? '';
        $this->numero_contato = $dados['numero_contato'] ?? '';
        $this->foto = $dados['foto'] ?? '';
        $this->castrado = $dados['castrado'] ?? false;
        $this->vacinado = $dados['vacinado'] ?? false;
    }
}