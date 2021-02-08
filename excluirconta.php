<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Usuario;
use \App\Entity\Upload;
use \App\Session\Login;

//OBRIGA O USUÁRIO A ESTAR LOGADO
Login::requireLogin();


//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
  header('location: adminpanel.php?status=error');
  exit;
}

//CONSULTA O PROJETO
$obUsuario = Usuario::getUsuario($_GET['id']);

//VALIDAÇÃO DO PROJETO
if(!$obUsuario instanceof Usuario){
  header('location: adminpanel.php?status=error');
  exit;
}

//VALIDAÇÃO DO POST
if(isset($_POST['excluir'])){

    $obUsuario->excluir();
  

  header('location: adminpanel.php?status=success');
  exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/confirmar-exclusaoconta.php';
include __DIR__.'/includes/footer.php';