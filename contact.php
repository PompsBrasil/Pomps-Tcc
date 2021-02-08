<?php
require __DIR__.'/vendor/autoload.php';

use App\Communication\Email;


//VALIDAÇÃO DAS INFORMAÇÕES
if(isset($_POST['address'],$_POST['name'],$_POST['subject'], $_POST['body'])){

    //INSTANCIA DO EMAIL
    $obEmail = new Email;

    $toaddress    = $_POST['address'];
    $toname     = $_POST['name'];
    $subject     = $_POST['subject'];
    $body     = "Email: ". $toaddress."<br/> Nome: ".$toname." <br/> ".$_POST['body'];

    $sucesso = $obEmail->sendEmail($toaddress, $toname, $subject, $body);
    
    $sucesso ?"Mensagem eviada com sucesso" : "Houve um problema,tente novamente o envio de e-mail";    
    
}

include __DIR__.'/includes/contact.php';


