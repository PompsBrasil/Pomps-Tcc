<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Projeto;
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
$obProjeto = Projeto::getProjeto($_GET['id']);

//VALIDAÇÃO DO PROJETO
if(!$obProjeto instanceof Projeto){
  header('location: adminpanel.php?status=error');
  exit;
}

//VALIDAÇÃO DO POST
if(isset($_POST['excluir'])){

  if(file_exists("files/$obProjeto->arquivo")){
      unlink("files/$obProjeto->arquivo");
      $obProjeto->excluir();
      echo"ARQUIVO EXCLUIDO COM SUCESSO ";
      header('location: adminpanel.php?status=success');
      exit;
  }

  header('location: adminpanel.php?status=error');
  exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/confirmar-exclusao.php';
include __DIR__.'/includes/footer.php';