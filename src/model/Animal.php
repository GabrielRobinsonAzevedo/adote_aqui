<?php

class Animal
{
    public $id;
    public $nome;
    public $sexo;
    public $especie;
    public $data_nascimento;
    public $porte;
    public $peso_atual;
    public $cor_pelagem;
    public $raca;
    public $descricao;
    public $numero_contato;
    public $foto;
    public $castrado;
    public $vacinado;

    public function __construct($dados)
    {
        $this->id = $dados['id'] ?? null;
        $this->nome = $dados['nome'] ?? '';
        $this->sexo = $dados['sexo'] ?? '';
        $this->especie = $dados['especie'] ?? '';
        $this->data_nascimento = $dados['data_nascimento'] ?? null;
        $this->porte = $dados['porte'] ?? '';
        $this->peso_atual = $dados['peso_atual'] ?? null;
        $this->cor_pelagem = $dados['cor_pelagem'] ?? '';
        $this->raca = $dados['raca'] ?? '';
        $this->descricao = $dados['descricao'] ?? '';
        $this->numero_contato = $dados['numero_contato'] ?? '';
        $this->foto = $dados['foto'] ?? '';
        $this->castrado = $dados['castrado'] ?? 0;
        $this->vacinado = $dados['vacinado'] ?? 0;
    }
}