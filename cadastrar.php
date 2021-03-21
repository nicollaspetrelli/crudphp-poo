<?php 

require_once __DIR__.'/vendor/autoload.php';

define('TITLE', 'Cadastrar vaga');

use NicollasDev\Entity\Vaga;
$vaga = new Vaga();

// VALIDAÇÃO DO POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    extract($_POST);

    if(isset($titulo, $descricao, $ativo)) {
        
        $vaga->setFields($titulo, $descricao, $ativo);
        $vaga->cadastrar();

        header('location: index.php?status=success');
        exit;
    }

}

require_once __DIR__.'/includes/header.php';
require_once __DIR__.'/includes/formulario.php';
require_once __DIR__.'/includes/footer.php';