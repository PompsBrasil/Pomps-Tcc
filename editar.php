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

  if(file_exists("files/$obProjeto->arquivo")){
    unlink("files/$obProjeto->arquivo");
}

  
  //VALIDAÇÃO DO POST
  if(isset($_POST['titulo'], $_POST['tipo'], $_FILES['arquivo'])){
      //INSTANCIA DE UPLOAD
      $obUpload = new Upload($_FILES['arquivo']);

      //MOVE OS ARQUIVOS DE UPLOAD
      $sucesso = $obUpload->upload(__DIR__.'/files',false);


        $obProjeto->titulo    = $_POST['titulo'];
        $obProjeto->tipo     = $_POST['tipo'];
        $obProjeto->arquivo  = $obUpload->getBasename();
        $obProjeto->atualizar();
        echo"ARQUIVO ATUALIZADO COM SUCESSO ";
    
    header('location: adminpanel.php?status=success');
    exit;
  }
  
  include __DIR__.'/includes/header.php';
  include __DIR__.'/includes/formedit.php';
  include __DIR__.'/includes/footer.php';
?>