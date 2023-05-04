<?php

class Pessoa
{
    private string $nome;

    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }
}