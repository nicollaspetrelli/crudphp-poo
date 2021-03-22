<?php 

require_once __DIR__.'/vendor/autoload.php';

use \NicollasDev\Entity\Vaga;
use \NicollasDev\Db\Pagination;

// Busca
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);

// Filtro de Status
$filtroStatus = filter_input(INPUT_GET, 'filtroStatus', FILTER_SANITIZE_STRING);
$filtroStatus = in_array($filtroStatus, ['s','n']) ? $filtroStatus : '';

// Condições SQL
$condicoes = [
    strlen($busca) ? 'titulo LIKE "%'.str_replace(' ','%', $busca).'%"' : null,
    strlen($filtroStatus) ? 'ativo = "'.$filtroStatus.'"' : null
];

// Remove posições vazias do array
$condicoes = array_filter($condicoes);

// Clausula WHERE
$where = implode(' AND ', $condicoes);

// Quantidade total de Vagas
$quantidadeVagas = Vaga::getQuantidadeVagas($where);

// Calculo de Paginação
$pagination = new Pagination($quantidadeVagas, $_GET['pagina'] ?? 1, 5);

// Obtem as Vagas
$vagas = Vaga::getVagas($where, null, $pagination->getLimit());

require_once __DIR__.'/includes/header.php';
require_once __DIR__.'/includes/listagem.php';
require_once __DIR__.'/includes/footer.php';