<?php
require_once 'ATM.php';
require_once 'Pessoa.php';
require_once 'ContaCorrente.php';
require_once 'BancoController.php';

$atm = new ATM(new BancoController());
$first = true;

while (1) {
    if(!$first){
        readline("Continuar...\n");
    }
    system('clear');
    $atm->printMenu();
    $opt = $atm->readOption();

    switch ($opt){
        case '1':
            $atm->abrirConta();
            break;
        case '2':
            $atm->sacar();
            break;
        case '3':
            $atm->depositar();
            break;
        case '4':
            $atm->transferir();
            break;
        case '9':
            echo "Finalizando...\n";
            die();
        default:
            echo "Opção inválida!\n";
            break;
    }
    $first = false;
}