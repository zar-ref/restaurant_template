<?php


/* CMS CLASS 
    Handle cms tasks to allow admin to view/edit content
*/


class Cms {
    private $content_types = array('wysiwyg' , 'text' , 'oneline' , 'onelineprice' , 'addrow');
    private $FP;
    function __construct() {
        global $FP;
        $this->FP = &$FP; //qualquer alteração no this->fp altera o global FP.
    }  

    function clean_block_id($id) { //flexionar o id a caracteres lower

        $id = str_replace( ' '  , '_' , $id   );
        $id = str_replace( '-'  , '_' , $id   );
        $id = preg_replace("/[^a-zA-Z0-9_]/", '', $id);
        return strtolower($id);
    }



    function display_block($id , $type ='wysiwyg' ) {
        
        
        //clean id
        $id = $this->clean_block_id($id);

        //ver se o tipo é valido
        $type = strtolower(htmlentities($type , ENT_QUOTES));
        if (in_array($type  , $this->content_types) == false) { //ve se o tipo esta no array

            echo  "<script>alert('Please enter a valid block type for \'" . $id . "\'');</script>";
            return;
        }



        ////get content
        $content = $this->load_block($id);
        if ($content === false) { //=== ver se sao iguais e teem o tipo igual

            ///create content
            $this->create_block($id);
            $content= '';

        }

        if ($this->FP->Auth->checkLoginStatus()){

            if($type == 'wysiwyg') { $type2 = 'WYSIWYG';}
            if($type == 'textarea') { $type2 = 'Textarea';}
            if($type == 'oneline') { $type2 = 'One Line';}
            if($type == 'onelineprice') { $type2 = 'One Line Price';}


            /////criar as divs que vão envolver a area
            $edit_start = '<div class="fp_edit">';
			$edit_type = '<a class="fp_edit_type" href="' . SITE_PATH . 'app/cms/edit.php?id='
				. $id . '&type=' . $type . '">' . $type2 . '</a>'; //indica o tipo de bloco
			$edit_link = '<a class="fp_edit_link" href="' . SITE_PATH . 'app/cms/edit.php?id=' 
				. $id . '&type=' . $type . '">Edit Block</a>'; //link para editar o bloco //VER VIDEO 30 PARA EDITAR O ESTILO
            $edit_end = '</div>';
            
            //echoar e meter o content associado
            echo $edit_start . $edit_type;
			echo $edit_link . $content . $edit_end;
        }

        else {

            echo $content;
        }
    }


    function generate_field($type , $content) { //gerar a dataa para dar displaY no v_edit.php

        //$content = utf8_encode($content1);
        if($type == 'wysiwyg') {
          
            return '<textarea name="field" id="field" class="wysiwyg">' . $content . '</textarea>';
        }

        else if($type == 'textarea') {
           return '<textarea name="field" id="field" class="textarea">' . $content . '</textarea>';
        }

        else if ($type == 'oneline') {
            //echo " content dentro do generate field = $content <br>";
            return "<input name='field' id='field' class='oneline' value= $content >";
        }

       


        else if ($type == 'addrow') {
            $begining = '<div class="addRowWrapper">';
            $name_tag = "<div class='addRowWrapper__nameTag'>Nome do prato</div>";
            $name_row = '<textarea name="fieldName" id="fieldName" class="addRowWrapper__name">'. '</textarea>';
            $description_tag = "<div  class='addRowWrapper__descriptionTag'>Descrição</div>";
            $description_row = '<textarea name="fieldDescription" id="fieldDescription" class="addRowWrapper__description">' . '</textarea>';
            $price_tag = "<div  class='addRowWrapper__priceTag'>Preço</div>";
            $price_row = '<input name="fieldPrice" id="fieldPrice" class="addRowWrapper__price" value="'.'"> ';

            $ending = '</div>';
            return $begining . $name_tag . $name_row . $description_tag . $description_row . $price_tag . $price_row . $ending;
        }

        else if($type == 'addMainMenuRow') {
            $begining = '<div class="addMainMenuRowWrapper">';
            $subMenuTag = "<div  class='addMainMenuRowWrapper__menuTag'>Tipo de prato</div>";
            $subMenuType = '<input name="fieldMenuType" id="fieldMenuType" class="addRowWrapper__menuType" value="'.'"> ';
            $ending = '</div>';
            return $begining . $subMenuTag . $subMenuType . $ending;

        }

        else { //tipo que nao existe
            $error = '<p>Please edit the block to use a valid content type:</p><ul>';

            foreach ($this->content_types as $content_type)
			{
				$error .= '<li>' . $content_type . '</li>';
			}
			$error .= '</ul>';
			return $error;
        }

    }

    function load_block($id) {
        //get content from database
        if($stmt = $this->FP->Database->prepare("SELECT content FROM content WHERE id = ?")){

            $stmt->bind_param('s', $id);
			$stmt->execute();
            $stmt->store_result();
            

            if ($stmt->num_rows != FALSE)
			{
				$stmt->bind_result($content); //mete o conteudo na variavel content
				$stmt->fetch();
				$stmt->close();
				return $content;
			}
			else
			{
                $stmt->close();
              
				return FALSE;
			}
        }
    }


    function create_block($id) //cria conteudo do tipo content_header etc que é o id do que se passa na funcção display block no idex.php
	{
		if ($stmt = $this->FP->Database->prepare("INSERT INTO content (id) VALUES (?)"))
		{
			$stmt->bind_param("s", $id);
			$stmt->execute();
			$stmt->close();
		}
    }
    
    function update_block($id, $content)
	{
		if ($stmt = $this->FP->Database->prepare("UPDATE content SET content = ? WHERE id = ?"))
		{
			$stmt->bind_param("ss", $content, $id);
			$stmt->execute();
			$stmt->close();
		}
	}
    
    
}