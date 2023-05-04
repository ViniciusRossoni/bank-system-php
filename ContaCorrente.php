<?php

class ContaCorrente
{
    private float $saldo;
    private int $agencia;
    private int $numero;
    private Pessoa $cliente;

    public function __construct($agencia, $numero, $cliente)
    {
        $this->saldo = 0;
        $this->agencia = $agencia;
        $this->numero = $numero;
        $this->cliente = $cliente;
    }

    /**
     * @return int
     */
    public function getAgencia(): int
    {
        return $this->agencia;
    }

    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    public function depositar(float $valor): bool
    {
        $this->saldo += $valor;
        return true;
    }

    public function sacar(float $valor): bool
    {
        if ($this->saldo < $valor) {
            return false;
        } else {
            $this->saldo -= $valor;
            return true;
        }
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }
}