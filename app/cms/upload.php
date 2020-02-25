<?php

include("../init.php");

$FP->Auth->checkAuthorization();

$statusMsg = '';

// File upload path
$targetDir = "uploads/";


/////////////////////////////////PARTE DE UPLOAD DE FICHEIROS ///////////
if(!is_dir($targetDir)) {

    mkdir($targetDir);
}



if(isset($_POST["submit"])){

    $fileName = basename($_FILES["file"]["name"]);
    //echo "filename = $fileName <br>";
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


    if( !empty($_FILES["file"]["name"])){
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif','pdf');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                echo $FP->Menu->statusImg();
                // Insert image file name into database
                if ($FP->Menu->statusImg() == false) {
                    $insert = $FP->Database->query(   "INSERT into 96images (img) VALUES ('".$fileName."')");
                }
                else {
                    $insert = $FP->Database->query(   "UPDATE 96images  SET img = ('".$fileName."')");
                
                }
                
                if($insert){
                    $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                    header('Refresh: 2; URL=' .SITE_PATH . 'menu.php' );
                    //$FP->Template->redirect(SITE_PATH . "menu.php");
                }else{
                    $statusMsg = "File upload failed, please try again.";
                    header('Refresh: 2; URL=' .SITE_PATH . 'menu.php' );
                    
                } 
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
                header('Refresh: 2; URL=' .SITE_PATH . 'menu.php' );
               
            }
        }else{
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
            header('Refresh: 2; URL=' .SITE_PATH . 'menu.php' );
            
        }
    }else{
        $statusMsg = 'Please select a file to upload.';
        header('Refresh: 2; URL=' .SITE_PATH . 'menu.php' );
        
        
       
    }
// Display status message
echo $statusMsg;
}


/////////////////////////////////////////////edita o prato do dia /////////////////


else if (  isset($_GET['tbname']) == true && isset($_GET['type']) ==true   ){

   
    $type = htmlentities($_GET['type'] , ENT_QUOTES);
    $tbname =utf8_decode($_GET['tbname']);
    //echo $tbname  . " tbname depois do utf8 decode<br>";
    $tbcol = $_GET['tbcol'];


 
    
    $content = $FP->Menu->load_main_dish_info($tbname , $tbcol );

   
    $FP->Template->setData('block_type' , $type);
    $FP->Template->setData('cms_field' , $FP->Cms->generate_field($type, $content) , false); //maybe um generae field também mais tarde
    $FP->Template->setData('block_table' , $tbname);
    $FP->Template->setData('table_column' , $tbcol);

    //load the view
    $FP->Template->load(APP_PATH . 'cms/views/v_main_dish.php');

}

else if(isset($_POST['field']) == true ){   
    //get data


   
    $type = htmlentities($_POST['type'] , ENT_QUOTES);
    $tbname = $_POST['tbname'];
    $content = $_POST['field'];
    $tbcol = $_POST['tbcol'];
    $FP->Menu->update_main_dish_table_entry($tbname , $tbcol , $content);



    //close colorbox and refresh the page
    $FP->Template->load(APP_PATH . "cms/views/v_saving.php");

    

}












?>