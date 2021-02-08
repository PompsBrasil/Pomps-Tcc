<?php
require __DIR__ .'/vendor/autoload.php';

use \App\Entity\Projeto;
use \App\Entity\Usuario;
use \App\Session\Login;

//OBRIGA O USUÁRIO A ESTAR LOGADO
Login::requireLogin();


$usuarios = Usuario::getUsuarios();
$projetos = Projeto::getProjetos();

include __DIR__ .'/includes/header.php';
include __DIR__ .'/includes/inicial.php';
include __DIR__ .'/includes/footer.php';