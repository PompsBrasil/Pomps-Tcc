<?php
require __DIR__ .'/vendor/autoload.php';    

    use \App\Entity\Upload;
    use \App\Entity\Projeto;
    use \App\Session\Login;

    //OBRIGA O USUÁRIO A ESTAR LOGADO
    Login::requireLogin();  

    
    $obProjeto = new Projeto;

    //VALIDAÇÃO DO POST
    if(isset($_POST['titulo'],$_POST['tipo'], $_FILES['arquivo'])){

        //INSTANCIA DE UPLOAD
        $obUpload = new Upload($_FILES['arquivo']);

        //MOVE OS ARQUIVOS DE UPLOAD
        $sucesso = $obUpload->upload(__DIR__.'/files',false);
        if($sucesso){
            //echo "Arquivo <strong>".$obUpload->getBasename()."</strong> enviado com sucesso";
            //$arquivonome = $obUpload->getBasename();
            
            $obProjeto->titulo    = $_POST['titulo'];
            $obProjeto->tipo      = $_POST['tipo'];
            $obProjeto->arquivo   = $obUpload->getBasename();
            $obProjeto->cadastrar();

            header('location:adminpanel.php?status=success');
            exit;
        }
        die('Problemas ao enviar o arquivo');
        
    }
    
    include __DIR__ .'/includes/header.php';
    include __DIR__ .'/includes/formularioport.php';
    include __DIR__ .'/includes/footer.php';
?>    