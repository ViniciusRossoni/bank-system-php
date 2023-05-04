<?php

class ATM
{
    private BancoController $controller;

    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    public function wait(): void
    {
        readline("Continuar...");
    }

    public function printMenu(): void
    {
        echo "1 - Criar Conta\n";
        echo "2 - Sacar\n";
        echo "3 - Depositar\n";
        echo "4 - Transferir\n";
        echo "9 - Finalizar\n";
    }

    public function readOption(): bool|string
    {
        return readline("Selecione sua opção: ");
    }

    public function getConta(): ContaCorrente
    {
        $agencia = readline("Digite a agência da conta: ");
        $numero = readline("Digite o número da conta: ");
        return $this->controller->getConta($agencia, $numero);
    }

    public function abrirConta(): void
    {
        echo "Abrindo conta....\n";
        echo "Digite o nome do cliente:";
        $nome = readline();
        $this->controller->abrirConta($nome);
    }

    public function depositar(): void
    {
        echo "Realizando depósito...\n";
        $conta = $this->getConta();
        if (!$conta) {
            echo "Conta não encontrada\n";
            return;
        }
        $conta->depositar(readline("Digite o valor que deseja depositar: "));
        echo "Saldo atual: R$" . $conta->getSaldo() . "\n";
    }

    public function sacar(): void
    {
        echo "Realizando saque...\n";
        $conta = $this->getConta();
        if (!$conta) {
            echo "Conta não encontrada\n";
            return;
        }
        if($conta->sacar(readline("Digite o valor que deseja sacar: "))) {
            echo "Saldo atual: R$" . $conta->getSaldo() . "\n";
        } else {
            echo "Saldo insuficiente\n";
        }
    }

    public function transferir(): void
    {
        echo "Realizando transferência...\n";
        $agencia = readline("Digite a agência da sua conta: ");
        $numero = readline("Digite o número da sua conta: ");
        $conta = $this->controller->getConta($agencia, $numero);
        if(!$conta) {
            echo "Conta não encontrada!\n";
            return;
        }

        $agencia_destino = readline("Digite a agência da conta destino: ");
        $numero_destino = readline("Digite o número da conta destino: ");
        $conta2 = $this->controller->getConta($agencia_destino, $numero_destino);
        if(!$conta) {
            echo "Conta destino não encontrada!\n";
            return;
        }

        if($agencia == $agencia_destino && $numero == $numero_destino) {
            echo "Você não pode transferir para sua conta";
            return;
        }

        $valor = readline("Digite o valor para transferir: ");
        if(!$conta->sacar($valor)){
            echo "Saldo insuficiente!\n";
            return;
        }
        $conta2->depositar($valor);
    }
}