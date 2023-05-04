<?php

class BancoController
{
    private array $contas;
    private int $agencia = 1;
    private int $numero_conta = 0;

    public function __construct()
    {
        $this->contas = [];
    }

    public function addConta(ContaCorrente $conta): void
    {
        $key = $conta->getAgencia() . "/" . $conta->getNumero();
        $this->contas[$key] = $conta;
    }

    /**
     * @param int $agencia
     * @param int $numero
     * @return ContaCorrente|bool
     */
    public function getConta(int $agencia, int $numero): ContaCorrente|bool
    {
        $key = $agencia . "/" . $numero;
        if (array_key_exists($key, $this->contas)) {
            return $this->contas[$key];
        } else {
            return false;
        }
    }

    public function abrirConta(string $nome): void
    {
        $cliente = new Pessoa($nome);
        $this->numero_conta++;
        $conta = new ContaCorrente($this->agencia, $this->numero_conta, $cliente);
        $this->addConta($conta);
    }
}