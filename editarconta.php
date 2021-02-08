<?php
require __DIR__.'/vendor/autoload.php';

use \App\Entity\Usuario;
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
  if(isset($_POST['nome'], $_POST['email'], $_POST['senha'])){
    //BUSCA USUÁRIO POR E-MAIL
    $verificar = Usuario::getUsuarioPorEmail($_POST['email']);
    if($verificar instanceof Usuario){
      header('location: adminpanel.php?status=error');
        exit;   
    }


        $obUsuario->nome    = $_POST['nome'];
        $obUsuario->email   = $_POST['email'];
        $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $obUsuario->atualizar();
    
    header('location: adminpanel.php?status=success');
    exit;
  }
  
  include __DIR__.'/includes/header.php';
  include __DIR__.'/includes/formeditconta.php';
  include __DIR__.'/includes/footer.php';
?>