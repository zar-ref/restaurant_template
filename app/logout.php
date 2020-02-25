<?php 




include("init.php"); //como temos q incluir com views vai.-se referenciar a pasta principal


//logout


$FP->Auth->logout();

//redirect the user


//$FP->Template->setAlert('Succesfully logged out!');
$FP->Template->redirect(SITE_PATH);


