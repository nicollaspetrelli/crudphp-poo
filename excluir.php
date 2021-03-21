<?php 

require_once __DIR__.'/vendor/autoload.php';

use NicollasDev\Entity\Vaga;

// Validação do ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;
}

// Instancia da Vaga
$vaga = Vaga::getVaga($_GET['id']);

if(!$vaga instanceof Vaga) {
    header('location: index.php?status=error');
    exit;
}


// Validação do POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['excluir'])) {
        $vaga->excluir();

        header('location: index.php?status=success');
        exit;
    }
}

require_once __DIR__.'/includes/header.php';
require_once __DIR__.'/includes/confirmar-exclusao.php';
require_once __DIR__.'/includes/footer.php';