<?php
require __DIR__ .'/vendor/autoload.php';

use \App\Entity\Usuario;
use \App\Session\Login;

//OBRIGA O USUÁRIO A ESTAR LOGADO
Login::requireLogin();

$usuarios = Usuario::getUsuarios();

include __DIR__ .'/includes/header.php';
include __DIR__ .'/includes/listagemconta.php';
include __DIR__ .'/includes/footer.php';