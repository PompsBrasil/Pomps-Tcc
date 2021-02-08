<?php
require __DIR__ .'/vendor/autoload.php';

use \App\Entity\Projeto;
use \App\Session\Login;

//OBRIGA O USUÁRIO A ESTAR LOGADO
Login::requireLogin();

$projetos = Projeto::getProjetos();

include __DIR__ .'/includes/header.php';
include __DIR__ .'/includes/listagem.php';
include __DIR__ .'/includes/footer.php';