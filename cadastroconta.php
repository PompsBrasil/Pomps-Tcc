<?php

require __DIR__ .'/vendor/autoload.php';    

    use \App\Entity\Upload;
    use \App\Entity\Usuario;
    use \App\Session\Login;

    //OBRIGA O USUÁRIO A ESTAR LOGADO
    Login::requireLogin();  
    
    //VALIDAÇÃO DOS CAMPOS OBRIGATÓRIOS
    if(isset($_POST['nome'], $_POST['email'], $_POST['senha'])){

        //BUSCA USUÁRIO POR E-MAIL
        $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
        if($obUsuario instanceof Usuario){
            header('location:adminpanel.php?status=email');
            exit;   
        }

        //NOVO USUÁRIO
        $obUsuario = new Usuario;
        $obUsuario->nome = $_POST['nome'];
        $obUsuario->email = $_POST['email'];
        $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $obUsuario->cadastrar();
        
        
       //LOGA O USUÁRIO
        Login::login($obUsuario);
        header('location:adminpanel.php?status=success');
        exit;
        
    }

    include __DIR__ .'/includes/header.php';
    include __DIR__ .'/includes/formularioconta.php';
    include __DIR__ .'/includes/footer.php';