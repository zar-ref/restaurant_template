<?php


include("../init.php");

$return = array('status'=>null);

if($_GET['key'] == 0){
    $FP->Menu->set_main_dish_status(TRUE);
    $return['status'] = 1;
}else{
    $FP->Menu->set_main_dish_status(FALSE);
    $return['status'] = 0;
}

die(json_encode($return));

?>