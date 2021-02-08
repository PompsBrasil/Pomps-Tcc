<?php
require __DIR__ .'/vendor/autoload.php';

use \App\Entity\Projeto;

$filtroTipos = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_STRING);
$filtroTipos = in_array($filtroTipos,['Post Promocional', 'Ilustração','Cartão de Visita', 'Logo', 'Identidade Visual']) ? $filtroTipos : '';

$condicoes = [
    strlen($filtroTipos) ? 'tipo = "'. $filtroTipos .'"' : null
];

$condicoes = array_filter($condicoes);
$where = implode (' AND ', $condicoes);

$projetos = Projeto::getProjetos($where);

include __DIR__ .'/includes/portfolio.php';
