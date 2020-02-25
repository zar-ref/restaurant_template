<?php 


include("../init.php");


$FP->Auth->checkAuthorization();


if (isset($_POST['field']) && (   ( isset($_POST['id']) == FALSE && isset($_POST['id_add_entry']) == FALSE  ) || isset($_POST['type']) == FALSE ))
{
	$FP->Template->error('', 'Please do not open up edit windows within a new window or tab.');
	exit;
}

///////////////////////////////////editar entradas dos sub menus //////////////////////////////////////////

else if(isset($_POST['field']) == true && isset($_POST['id'])==true ){   
    //get data


    $id = $FP->Cms->clean_block_id($_POST['id']);
    $type = htmlentities($_POST['type'] , ENT_QUOTES);
    $tbname = $_POST['tbname'];
    $content = $_POST['field'];
    $tbcol = $_POST['tbcol'];
    $FP->Menu->update_table_entry($tbname , $tbcol , $id , $content);



    //close colorbox and refresh the page
    $FP->Template->load(APP_PATH . "cms/views/v_saving.php");

    

}


else if (  isset($_GET['id']) == true && isset($_GET['type']) ==true   ){
    if( isset($_GET['id']) == false || isset($_GET['type']) ==false ){
        ;
        $FP->Template->error();
        exit;
    }
   
    
    $id =$_GET['id'];
    $type = htmlentities($_GET['type'] , ENT_QUOTES);
    //$tbname = $_GET['tbname'];   
    $tbname =utf8_decode($_GET['tbname']);
    //echo $tbname  . " tbname depois do utf8 decode<br>";
    $tbcol = $_GET['tbcol'];
   // $id_add_entry = $_GET['id_add_entry'];
    //echo $id_add_entry;

 
    
    $content = $FP->Menu->load_info($tbname , $tbcol , $id);

    $FP->Template->setData('block_id' , $id);
    $FP->Template->setData('block_type' , $type);
    $FP->Template->setData('cms_field' , $FP->Cms->generate_field($type, $content) , false); //maybe um generae field também mais tarde
    $FP->Template->setData('block_table' , $tbname);
    $FP->Template->setData('table_column' , $tbcol);

    //load the view
    $FP->Template->load(APP_PATH . 'cms/views/v_menu_edit.php');

}

//////////////////////editar entradas do menu principal ///////////////////
else if(isset($_GET['menu_id']) == true && isset($_GET['tbname'])==true ){
    $id =$_GET['menu_id'];
    $tbname = utf8_decode($_GET['tbname']);
    //echo "olaaaaaaaaaa tenho tbname = $tbname<br>";
    $content = $FP->Menu->load_main_menu_info($id);
    //echo "olaaaaaaaaaa tenho content = $content<br>";
    $FP->Template->setData('block_table' , $tbname);
    $FP->Template->setData('block_id' , $id);
    $FP->Template->setData('block_type' , "oneline");
    $FP->Template->setData('cms_field' , $FP->Cms->generate_field("oneline", $content) , false); //maybe um generae field também mais tarde
    $FP->Template->load(APP_PATH . 'cms/views/v_menu_subtitle_edit.php');

}

else if(isset($_POST['menu_id_to_change'])==true  && isset($_POST['content']) == true){   
    $menu_id_to_change = $_POST['menu_id_to_change'];
    $content = $_POST['content'];   
    $FP->Menu->update_menu_type($menu_id_to_change, $content);   
    $FP->Template->load(APP_PATH . "cms/views/v_saving.php");
}



////////////////////////////////////adicionar entradas no menu /////////////////////////////////
else if (  isset($_GET['id_add_entry']) == true && isset($_GET['type']) ==true   ){ //acrescentar entrada na base de dados
    if( isset($_GET['id_add_entry']) == false || isset($_GET['type']) ==false ){
        $FP->Template->error();
        exit;
    }
   
    $id_add_entry = $_GET['id_add_entry'];
    $type = htmlentities($_GET['type'] , ENT_QUOTES);
    $tbname =utf8_decode($_GET['tbname']);   
    //echo $tbname . " antes de enviar para  o menu add row<br>";
    
   
    $FP->Template->setData('block_id' , $id_add_entry);
    $FP->Template->setData('block_type' , $type);
    $FP->Template->setData('block_table' , $tbname);
    $FP->Template->setData('cms_field' , $FP->Cms->generate_field($type, '') , false);
    //echo $FP->Template->getData('block_table') . " aidna antes <br>";
    if($type == 'addrow'){ ////////////////adicionar linhas nos tipos de menu
        //load the view
        $FP->Template->load(APP_PATH . 'cms/views/v_menu_add_row.php');
    }
    else if($type == 'addMainMenuRow'){ /////////////////adicionar linhas no main menu
        $FP->Template->load(APP_PATH . 'cms/views/v_menu_add_main_row.php');

    }

}

///   entradas nas tabelas dos sub menus
else if( (  isset($_POST['newName']) == true  ||  isset($_POST['newDescription']) == true  ||  isset($_POST['newPrice']) == true  ) && isset($_POST['id_add_entry'])==true ){ //////adicionar entradas
    //get data

    //echo "<script>alert('ola');</script>";
    $id= $_POST['id_add_entry'];
    $tbname = $_POST['tbname'];
    //echo $tbname . "<br>";
    $newName = $_POST['newName'];
    $newDescription = $_POST['newDescription'];
    $newPrice = $_POST['newPrice'];

    $FP->Menu->insert_table_entry($tbname , $id , $newName , $newDescription , $newPrice);

    $FP->Template->load(APP_PATH . "cms/views/v_saving.php");

    

}

///////////////////////////////////ADICIONAR NA TABELA DO MAIN MENU
else if (isset($_POST['id_add_entry']) == true  &&  isset($_POST['tbname']) == true &&  isset($_POST['newMenuType']) == true ) {
   
    $id= $_POST['id_add_entry'];
    $tbname = $_POST['tbname'];
    $newMenuType =$_POST['newMenuType'];
    //echo "<script>alert($tbname);</script>";
    //echo "dentro do menu edit tenho menu type = ". $newMenuType . " E TBNAME =  $tbname\n";
    //echo "olaa";
    $FP->Menu->insert_main_menu_table_entry($tbname , $id , $newMenuType);
    //echo "cheguei aquiii";
    $FP->Template->load(APP_PATH . "cms/views/v_saving.php");

}


////////////////////////apagar entradas de uma linha do menu

else if(isset($_GET['id_delete']) == true && isset($_GET['tbname']) ==true ) {
    //echo "<script>alert('estou no menu edit');</script>";
    $tbname = utf8_decode($_GET['tbname']);
    $id_del = $_GET['id_delete'];
    $name =  $FP->Menu->getName($tbname , $id_del);
   
    $FP->Template->setData('id_to_delete' , $id_del);
    $FP->Template->setData('name_to_delete' , $name);
    $FP->Template->setData('tbname' , $tbname);
    $FP->Template->load(APP_PATH . 'cms/views/v_menu_delete_row.php');

    
}
else if(isset($_POST['id_ready_to_delete'])){
    //echo "<script>alert('estou no menu edit');</script>";
    $id_to_delete = $_POST['id_ready_to_delete'];
    $tbname = $_POST['tbname'];
    $FP->Menu->delete_table_row($tbname , $id_to_delete);
    $FP->Template->load(APP_PATH . "cms/views/v_saving.php");

}
///////////APAGAR ENTRADAS DO MENU PRINCIPAL
else if(isset($_GET['menu_id_delete']) == true && isset($_GET['tbname']) ==true && isset($_GET['tbcode']) ==true ){
    $tbname = utf8_decode($_GET['tbname']);   
    $id_del = $_GET['menu_id_delete'];
    //echo $tbname . "<br>";
    $FP->Template->setData('id_to_delete' , $id_del);
    $FP->Template->setData('tbname' , $tbname);
    $tbcode = $_GET['tbcode'];
    $FP->Template->setData('tbcode' , $tbcode);

    $FP->Template->load(APP_PATH . 'cms/views/v_main_menu_delete_row.php');
    

}

else if(isset($_POST['menu_id_ready_to_delete']) ==true  && isset($_POST['tbname']) ==true  && isset($_POST['tbcode']) == true ){
    //echo "<script>alert('estou no menu edit');</script>";
    //echo "primeiro menu edit \n";
    $id_to_delete = $_POST['menu_id_ready_to_delete'];
    $tbname = $_POST['tbname'];
    $tbcode = $_POST['tbcode'];
    //echo "tbname = " . $tbname . " denttro da menu edit  com menu_id = $id_to_delete e tbcode = $tbcode \n";
    ///$FP->Menu->delete_table_row($tbname , $id_to_delete);
    $FP->Menu->delete_main_menu_row($tbcode , $id_to_delete);
    $FP->Template->load(APP_PATH . "cms/views/v_saving.php");

}





else {
    $FP->Template->error();
    exit;
}


