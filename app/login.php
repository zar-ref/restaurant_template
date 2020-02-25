




<?php 
include("init.php");


if( isset($_POST['username'])) {
    //get data se for submito com exito
    $FP->Template->setData('input_user' , $_POST['username']);
    $FP->Template->setData('input_pass' , $_POST['password']);

    ///validar os dados
    if($_POST['username'] == '' || $_POST['password'] == ''){   //meter os fields a bracno

        //show error message
        if ($_POST['username'] == '') {
             $FP->Template->setData('error_user', 'required');
        }
		if ($_POST['password'] == '') { 
            $FP->Template->setData('error_pass', 'required');
        }

        $FP->Template->setAlert('Please fill in all requeired fields' , 'error');
        echo '<script type=text/javascript>jQuery.colorbox.resize(); </script>';
        $FP->Template->load(APP_PATH . "core/views/v_login.php");//vai meter o login denovo depois de criar o alert
        
    }

    else if ($FP->Auth->validateLogin($FP->Template->getData('input_user') , $FP->Template->getData('input_pass')) == false){ //falhar o login
        //invalid login
        $FP->Template->setAlert('Invalid username or passwword' , 'error');
        echo '<script type=text/javascript>jQuery.colorbox.resize(); </script>';
        $FP->Template->load(APP_PATH . "core/views/v_login.php");//vai meter o login denovo depois de criar o alert
  
    }

    else { //login correu bem
        //success login
        $_SESSION['username'] = $FP->Template->getData('input_user');
        $_SESSION['loggedin'] = true;
        $FP->Template->load(APP_PATH . "core/views/v_loggingin.php");
    }


}
else {
    
    $FP->Template->load(APP_PATH . "core/views/v_login.php");
    
}




