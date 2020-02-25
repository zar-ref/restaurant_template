<?php 


include("../init.php");

////////////////////ADICIONAR EMAILS A TABELA DE CLIENTES ////////////////////////

if (   isset($_POST['nome']) && isset($_POST['email']) )  {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $flag = $FP->Template->addClient($email , $nome);

    if($flag == true ){
        echo "Obrigado pelo seu contacto";
    }
    else {
        echo "Já temos o seu contacto";
    }
}

//////////////////////APAGAR CLIENTES //////////////////////

else if(isset($_GET['email_delete'])){
    
    $email = utf8_decode($_GET['email_delete']);
    
   
    $FP->Template->delete_client($email);
    $FP->Template->load(APP_PATH . 'dashboard/views/v_clients.php');

}



////// LOAD THE VIEW /////////////

else {
    echo "<script>alert('olaaaaa');</script>";
    $FP->Template->load(APP_PATH . 'dashboard/views/v_clients.php');
}




