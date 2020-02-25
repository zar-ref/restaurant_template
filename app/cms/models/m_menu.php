<?php 



/* MENU CLASS 
    Handle cms tasks for menu
*/


class Menu {

    private $FP;    
    public $menu_types = array();
    public $menu_types2 = array();
    public $menu_name = '96menu';

    function __construct(){
        global $FP;
        $this->FP = &$FP;
        
    }

   



   function getMenuTypes() {
     

        $result = $this->FP->Database->query("SELECT type FROM $this->menu_name");
        
        if($result->num_rows == false) {
            
            return FALSE;
        }
        else {


            while($row = $result->fetch_assoc()){ //enquanto estivermos a olhar pra o banco
               
                
                array_push($this->menu_types  , $row['type']);
            
            }      
 
            return TRUE;
        }
    }

    function getMenuTypes2() {
     

        $result = $this->FP->Database->query("SELECT type FROM $this->menu_name");
        
        if($result->num_rows == false) {
           
            return FALSE;
        }
        else {


            while($row = $result->fetch_assoc()){ //enquanto estivermos a olhar pra o banco
               
                
                array_push($this->menu_types2  , $row['type']);
            
            }      
 
            return TRUE;
        }
    }

    //////////////////////////////////CODIGOS PARA OS TITULOS DASS TABELAS

    function rename_table($tbname, $newName){
        
        $stmt = "RENAME TABLE `$tbname` TO `$newName` ;";
        $this->FP->Database->query($stmt);
        return;
    }


    function getMenuTypeFromId($menu_id){
        $stmt_search = $this->FP->Database->prepare( "SELECT type FROM `$this->menu_name` WHERE id = ?;");
		$stmt_search->bind_param("i" , $menu_id);
		$stmt_search->execute();		
        $result = $stmt_search->get_result();
        $row = $result->fetch_assoc();
        $menu_type = $row['type'];
        $stmt_search->close();
        return $menu_type;
    }
    function tbname_to_code($menu_id) {
        $code = 'rvgnbil' . $menu_id;
        return $code;
    }
    function code_to_tbname($menu_id){
        $tbname = $this->getMenuTypeFromId($menu_id);
        return $tbname;
    }
    function temp_code($tbname) {
       
        $id = substr($tbname, -1);
        $code = "libngvr". $id;
        $this->rename_table($tbname , $code);
        return $code;

    }
    function temp_code2($tbname) {
       
        $this->rename_table($tbname , "gvrlibn");
        return "gvrlibn";

    }

    function value_to_id($menu_type) {
        $stmt_search = $this->FP->Database->prepare( "SELECT id FROM `$this->menu_name` WHERE type = ?;");
		$stmt_search->bind_param("s" , $menu_type);
		$stmt_search->execute();		
        $result = $stmt_search->get_result();
        $row = $result->fetch_assoc();
        $menu_id = $row['id'];
        
        $stmt_search->close();
        return $menu_id;
    }
    function value_to_tbname ($menu_type){

        $stmt_search = $this->FP->Database->prepare( "SELECT id FROM `$this->menu_name` WHERE type = ?;");
		$stmt_search->bind_param("s" , $menu_type);
		$stmt_search->execute();		
        $result = $stmt_search->get_result();
        $row = $result->fetch_assoc();
        $menu_id = $row['id'];
        $tbname = 'rvgnbil' . $menu_id;
        
        $stmt_search->close();
        return $tbname;
    }

////////////////////////////////////////funcionalidades básicas com tabelas

    function load_main_menu_info($id){
        

        $stmt = $this->FP->Database->prepare("SELECT type FROM `$this->menu_name` WHERE id= ?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result =  $stmt->get_result();
        $info = $result->fetch_assoc();
        $stmt->close();
        
        return $info["type"];
   }



    function load_info($tbname , $tbcol , $id) {

        $stmt = $this->FP->Database->prepare( "SELECT $tbcol FROM `$tbname` WHERE `id` = ? ;" );
        $stmt->bind_param("i" , $id);
        $stmt->execute();
        $result =  $stmt->get_result();
        $info = $result->fetch_assoc();       
        $stmt->close();
       
        return $info["$tbcol"];
     

     
    }



    function update_menu_type($id, $content){
      
               
        $stmt = $this->FP->Database->prepare("UPDATE  $this->menu_name SET `type` = ? WHERE id = ?;"); 
        $stmt->bind_param("si", $content, $id);
        $stmt->execute();
        $stmt->close();
        return;
        
    }

    

    function get_menu_type_id($tbname , $type) {
        
        $stmt =  $this->FP->Database->prepare("SELECT id FROM $this->menu_name WHERE type=?;");
        $stmt->bind_param("s" , $type);
        $stmt->execute();	
        

        $result =$stmt->get_result();
        $id = $result->fetch_row();
        return $id[0];


    }
    function getName($tbname , $id) {
        $stmt = "SELECT name FROM `$tbname` WHERE id=$id";
        $result = $this->FP->Database->query($stmt);
        $name = $result->fetch_row();
        return $name[0];

    }

    function select_after($tbname, $id_after) {
        $stmt_after =  "SELECT name, description, price FROM `$tbname` WHERE id >= $id_after;";
        $result = $this->FP->Database->query($stmt_after);
        return $result;
    }

    function select_before($tbname, $id_before) {
        $stmt_before =  "SELECT name, description, price FROM `$tbname` WHERE id <= $id_before;";
        $result = $this->FP->Database->query($stmt_before);
        return $result;
    }

    function select_main_menu_after($tbname, $id_after) {
        $stmt_after =  "SELECT type FROM `$tbname` WHERE id >= $id_after;";
        $result = $this->FP->Database->query($stmt_after);
        return $result;
    }

    function select_main_menu_before($tbname, $id_before) {

        $stmt_before =  "SELECT type FROM $tbname WHERE id <= $id_before;";

        $result = $this->FP->Database->query($stmt_before);
        return $result;
    }
    
    function get_max_id($tbname){
        $stmt_max = "SELECT MAX(id) FROM `$tbname`";
        $result= $this->FP->Database->query($stmt_max); 
        $max_id  = $result->fetch_row();
        return $max_id[0];
    }


    function drop_table ($tbname) {
        $stmt_drop = "DROP TABLE `$tbname`;";
        $this->FP->Database->query($stmt_drop);

    }
    function create_new_main_table($tbname){
        $stmt_create_new_main_table = "CREATE TABLE $tbname (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `type` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            PRIMARY KEY (`id`)
          ) ;";

        $this->FP->Database->query($stmt_create_new_main_table);
    }

    function create_new_table ($tbname) {

       

        $stmt_create_new_table = "CREATE TABLE `$tbname` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            `price` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            PRIMARY KEY (`id`)
          ) ;";

        $this->FP->Database->query($stmt_create_new_table);


    }

    function insert_into_main_menu_table($tbname ,$menuType) {
       

        $stmt_insert = $this->FP->Database->prepare("INSERT INTO $tbname ( id, type) VALUES ( NULL , ?);");
		$stmt_insert->bind_param("s", $menuType);
		$stmt_insert->execute();	
		$stmt_insert->close();
       
    }

    function insert_into_table($tbname , $name, $description, $price) {
        
        $stmt_insert = $this->FP->Database->prepare("INSERT INTO `$tbname` ( id, name , description , price) VALUES ( NULL , ? , ? , ?);");
        $stmt_insert->bind_param("sss", $name , $description , $price);
		$stmt_insert->execute();	
		$stmt_insert->close();
    }



    function update_table_entry($tbname , $tbcol , $id , $content) {
       
       
        $stmt_update = $this->FP->Database->prepare( "UPDATE `$tbname`  SET $tbcol = ? WHERE id = ?;");
        $stmt_update->bind_param("si", $content , $id);
		$stmt_update->execute();	
		$stmt_update->close();



    }

    function insert_main_menu_table_entry($tbname , $id_new_entry , $newMenuType){

        
        if($id_new_entry == 0) { //insercção no inicio
       
           
            // $this->drop_table($tbname);
            // $this->create_new_main_table($tbname);
           
            
            
            
           
          
        

            $code=$this->tbname_to_code(1);
            


            
            $stmt_select_all = "SELECT * FROM $tbname;" ;
           

            $result = $this->FP->Database->query($stmt_select_all);

            if($result->num_rows == 0){
                $this->create_new_table($code);
                $this->insert_into_main_menu_table($tbname , $newMenuType);
                return;
            }
            else if($result->num_rows == 1) {
                $firstrow = $result->fetch_assoc();
                $id = $firstrow['id'];
                $type = $firstrow['type'];
                $code_before=$this->tbname_to_code($id);
                $xxx = $this->temp_code($code_before);
                $code=$this->tbname_to_code(1);
                $this->create_new_table($code);
                $code=$this->tbname_to_code(2);
                $this->rename_table($xxx, $code);
                $this->drop_table($tbname);
                $this->create_new_main_table($tbname);
                $this->insert_into_main_menu_table($tbname , $newMenuType);
                $this->insert_into_main_menu_table($tbname , $type);
                return;

            }
            $this->drop_table($tbname);
            $this->create_new_main_table($tbname);
           
            $this->insert_into_main_menu_table($tbname , $newMenuType);

            
            $firstrow = $result->fetch_assoc();
            
            $id = $firstrow['id'];
            $type = $firstrow['type'];
            $this->insert_into_main_menu_table($tbname , $type);
            $code_first=$this->tbname_to_code($id);
            $xxx = $this->temp_code($code_first);
            $code_new = NULL;
            
            while($row = $result->fetch_assoc()){

               
                $id = $row['id'];
                $type = $row['type'];
                $id_new = $id+1;
               

                $code_before=$this->tbname_to_code($id);
                $code_new=$this->tbname_to_code($id_new);
               

                $yyy = $this->temp_code($code_new);
               

                $this->rename_table($xxx, $code_new);

              
                
                
                $xxx = $yyy;
       
                $this->insert_into_main_menu_table($tbname , $type);

            }
            
           
            $this->create_new_table($code);
         
        }

        else {
            $max_id = $this->get_max_id($tbname);
            if ($id_new_entry < $max_id ) { ///inserseção no meio
             
                
                $id_before = $id_new_entry - 0.5;
                $id_after = $id_new_entry + 0.5;

                
                $before = $this->select_main_menu_before($tbname , $id_before);
                $after = $this->select_main_menu_after($tbname , $id_after);
                $this->drop_table($tbname);
                $this->create_new_main_table($tbname);

                while($row = $before->fetch_assoc()) {
                    $type = $row['type'];//utf8_encode($row['name']);///utd8 encode
                   
                    $this->insert_into_main_menu_table($tbname , $type);
                }
                
                
                $this->insert_into_main_menu_table($tbname , $newMenuType);
                $id_before++;
              
                $code=$this->tbname_to_code($id_before);
               
                $xxx = $this->temp_code($code);
                $code_new = NULL;

                while($row = $after->fetch_assoc()) {
                    
                    $code_before=$this->tbname_to_code($id_before);
                    $id_before++;
                    $type = $row['type'];
                   
                    $code_new=$this->tbname_to_code($id_before);
                   
                    $yyy = $this->temp_code($code_new);
                    $this->rename_table($xxx, $code_new);
                    $xxx = $yyy;
                   
                    

                    $this->insert_into_main_menu_table($tbname , $type);
                }
                $this->create_new_table($code);
            
            
            }
            else {
                
                $code=$this->tbname_to_code($max_id+1);
                $this->insert_into_main_menu_table($tbname , $newMenuType);
                $this->create_new_table($code);
                
            }


        }

        echo "Done";
        return;

    }

    function insert_table_entry($tbname , $id_new_entry , $newName , $newDescription , $newPrice) {


        if($id_new_entry == 0) { //insercção no inicio

            $stmt_select_all = "SELECT * FROM `$tbname`;" ;
           
            $result = $this->FP->Database->query($stmt_select_all);
            $this->drop_table($tbname);
            $this->create_new_table($tbname);
            $this->insert_into_table($tbname , $newName , $newDescription , $newPrice);

            while($row = $result->fetch_assoc()){
                
                $name = $row['name'];//utf8_encode($row['name']);///utd8 encode
                $description = $row['description'];
                $price = $row['price'];
                $this->insert_into_table($tbname , $name , $description , $price);

              }
             
        }

        else {

            $max_id = $this->get_max_id($tbname);

            if ($id_new_entry < $max_id) { ///inserseção no meio
                $id_before = $id_new_entry- 0.5;
                $id_after = $id_new_entry + 0.5;
                
                $before = $this->select_before($tbname , $id_before);
                $after = $this->select_after($tbname , $id_after);
                $this->drop_table($tbname);
                $this->create_new_table($tbname);

                while($row = $before->fetch_assoc()) {
                    $name = $row['name'];
                    $description = $row['description'];
                    $price = $row['price'];
                    
                    $this->insert_into_table($tbname , $name , $description , $price);                
                }

                $this->insert_into_table($tbname , $newName , $newDescription , $newPrice);

                while($row = $after->fetch_assoc()) {
                    $name = $row['name'];
                    $description = $row['description'];
                    $price = $row['price'];
                   
                    $this->insert_into_table($tbname , $name , $description , $price);                
                }

            }
            else { ///id maior que todos os que estão na tabela --> inserir no ultimo
                $this->insert_into_table($tbname , $newName , $newDescription , $newPrice);
            }

        }

        
    }

    function delete_table_row($tbname , $id_to_delete) {
        


        if($id_to_delete == 1) {                    //////////////////apagar o primeiro
            $after =  $this->select_after($tbname , $id_to_delete +1);//selecionar a partir do 2 até ao fim
            $this->drop_table($tbname);
            $this->create_new_table($tbname);
            while($row = $after->fetch_assoc()) {
                $name = $row['name'];
                $description = $row['description'];
                $price = $row['price'];
               
                $this->insert_into_table($tbname , $name , $description , $price);                
            }


        }
        else if( $id_to_delete < $this->get_max_id($tbname)) { // apagar no meio
            $before = $this->select_before($tbname , $id_to_delete - 1);
            $after = $this->select_after($tbname , $id_to_delete + 1);
            $this->drop_table($tbname);
            $this->create_new_table($tbname);
            while($row = $before->fetch_assoc()) {
                $name = $row['name'];
                $description = $row['description'];
                $price = $row['price'];
                
                $this->insert_into_table($tbname , $name , $description , $price);                
            }
            while($row = $after->fetch_assoc()) {
                $name = $row['name'];
                $description = $row['description'];
                $price = $row['price'];
               
                $this->insert_into_table($tbname , $name , $description , $price);                
            }


        }
        else { //id é igual ao último
            $before = $this->select_before($tbname , $id_to_delete - 1);
            $this->drop_table($tbname);
            $this->create_new_table($tbname);
            while($row = $before->fetch_assoc()) {
                $name = $row['name'];
                $description = $row['description'];
                $price = $row['price'];
                
                $this->insert_into_table($tbname , $name , $description , $price);                
            }


        }
        return;
         

    }

    function delete_main_menu_row($tbname , $id_to_delete){
       
        
        if($id_to_delete == 1) {                    //////////////////apagar o primeiro

         
            $after =  $this-> select_main_menu_after($this->menu_name, $id_to_delete +1) ;//selecionar a partir do 2 até ao fim
            
            $this->drop_table($this->menu_name);
            $this->drop_table($tbname);
            $this->create_new_main_table($this->menu_name);
            
            
            $code=$this->tbname_to_code($id_to_delete);
            
            $id = $id_to_delete +1;
            while($row = $after->fetch_assoc()) {
                $type = $row['type'];//utf8_encode($row['name']);///utd8 encode
                
                $code_atual = $this->tbname_to_code($id);
               
                $this->rename_table($code_atual, $code);
                $code = $code_atual;
                $id++;
                $this->insert_into_main_menu_table($this->menu_name , $type);           
            }
          


        }

        else if( $id_to_delete < $this->get_max_id($this->menu_name)) { // apagar no meio
            $before = $this->select_main_menu_before($this->menu_name , $id_to_delete - 1);
            $after = $this->select_main_menu_after($this->menu_name , $id_to_delete + 1);
            $this->drop_table($this->menu_name);
            $this->drop_table($tbname);
            $this->create_new_main_table($this->menu_name);

           


            while($row = $before->fetch_assoc()) {
                $type = $row['type'];//utf8_encode($row['name']);///utd8 encode
                $this->insert_into_main_menu_table($this->menu_name, $type);   

            }

            $code=$this->tbname_to_code($id_to_delete);
           
            $id = $id_to_delete +1;

            while($row = $after->fetch_assoc()) {
                $type = $row['type'];//utf8_encode($row['name']);///utd8 encode
            

                $code_atual = $this->tbname_to_code($id);

                $this->rename_table($code_atual, $code);
                $code = $code_atual;
                $id++;

                $this->insert_into_main_menu_table($this->menu_name , $type);   

            }


        }
        else { //id é igual ao último
            $before = $this->select_main_menu_before($this->menu_name , $id_to_delete - 1);
            $this->drop_table($this->menu_name);
            $this->drop_table($tbname);
            $this->create_new_main_table($this->menu_name);
            while($row = $before->fetch_assoc()) {
                $type = $row['type'];//utf8_encode($row['name']);///utd8 encode
                
                $this->insert_into_main_menu_table($this->menu_name , $type);                  
            }


        }

        
    }

////////////////////////////fim das funções básicas de tabelas /////////////////

//////////////funções auxiliares do menu
                ////urlencode(utf8_encode($tbname)) 

    function echo_menu_delete_row ($tbname , $id, $name){
       

        $delete_start = '<div class="menuEdit__row__delete"> <!--- incicio do menu content--->';

        $delete_link = '<a class="menuEdit__row__link__delete' .  '" href="' . SITE_PATH . 'app/cms/menu_edit.php?id_delete='
            . $id   . '&tbname=' . urlencode(utf8_encode($tbname))  .  '">' . ' <div class="menuEdit__row__link__delete__content"> <span class="menuEdit__row__link__delete__content__p"> delete</span> </div>'. '</a>'; //indica o tipo de bloco
       
       
       
      
        
        $delete_end = '<!--- fim do menu edit content---> </div> ';


        return $delete_start . $delete_link  . $delete_end;
       

    }


    function echo_menu_row ( $tbname , $colname , $id  , $type , $text , $content) {
        $edit_start = '<div class="menuEdit__row__' . "$colname" . '" > <!--- incicio do menu content--->';

        $edit_type = '<a class="menuEdit__row__type__' . "$colname" . '" href="' . SITE_PATH . 'app/cms/menu_edit.php?id='
            . $id . '&type=' . $type   . '&tbname=' . urlencode(utf8_encode($tbname)) . '&tbcol=' . "$colname" . '">' . $text . '</a>'; //indica o tipo de bloco
        $edit_link = '<a class="menuEdit__row__link__' . "$colname" .  '" href="' . SITE_PATH . 'app/cms/menu_edit.php?id=' 
            . $id . '&type=' . $type  . '&tbname=' . urlencode(utf8_encode($tbname))   . '&tbcol=' . "$colname" . '"></a>'; //link para editar o bloco //VER VIDEO 30 PARA EDITAR O ESTILO

        $edit_end = '<!--- fim do menu edit content---> </div> ';

        $content_div = '<!--- fim do $colname---> <div class= "menuEdit__row__' . "$colname" . "__content" .'" > '. "$content" . '</div>';

       

        return $edit_start . $edit_type . $edit_link . $content_div . $edit_end;
       

    }

    function echo_menu_addRow($tbname  , $id_add_entry  , $type , $text ) {

        $edit_start_add_entry = '<div class="menuEdit__row__add" > <!--- incicio do menu add row--->';
                            
        $edit_type_add_entry = '<a class="menuEdit__row__add__link" href="' . SITE_PATH . 'app/cms/menu_edit.php?id_add_entry='
            . $id_add_entry . '&type=' . $type   . '&tbname=' . urlencode(utf8_encode($tbname)) .  '">' .  ' <div class="menuEdit__row__add__link__content"> <span class="menuEdit__row__add__link__content__p">'.  "$text" . ' </span> </div>'. '</a>'; //indica o tipo de bloco
        
        
         
        $edit_end_add_entry = '<!--- fim do menu add row---> </div> ';

       

        return $edit_start_add_entry . $edit_type_add_entry  . $edit_end_add_entry;
         


    }

    function echo_add_main_menu_row($tbname , $id_add_entry , $type , $text) {
        $menu_start_add_entry = '<div class="menuEdit__row__menuSubtitle" > <!--- incicio do menu add row--->';
                            
        $menu_link_add_entry = '<a class="menuEdit__row__menuSubtitle__link" href="' . SITE_PATH . 'app/cms/menu_edit.php?id_add_entry='
            . $id_add_entry . '&type=' . $type   . '&tbname=' . $tbname .  '">' . '<div class="menuEdit__row__menuSubtitle__link__content"> <span class="menuEdit__row__menuSubtitle__link__content__p">' . "$text"  .'</span> </div>'  . '</a>'; //indica o tipo de bloco
     
        $menu_end_add_entry = '<!--- fim do menu add MenuSubtitle --> </div> ';

        $menu_content_add_entry = " <div > <h3>add Menu subtitle </h3></div>  ";
        
        return $menu_start_add_entry . $menu_link_add_entry . $menu_end_add_entry;

    }

    function echo_menu_subTitle($tbname , $id){

        $value = $this->value_to_tbname($tbname);
        

        
        $wrapper_begin = "<div class='menu__subTitle'>";

        
        $title = "<div class='menu__subTitle__title'> " .  '<a class="menu__subTitle__title__edit' .  '" href="' . SITE_PATH . 'app/cms/menu_edit.php?menu_id='
        . $id   . '&tbname=' . urlencode(utf8_encode($tbname)) .  '">' . "editar". '</a>' . "</div> "; 

        $title_type = '<a class="menu__subTitle__type' .  '" href="' . SITE_PATH . 'app/cms/menu_edit.php?menu_id='
        . $id   . '&tbname=' . urlencode(utf8_encode($tbname)) .  '">' . "editar". '</a>' ;


        $delete = '<a class="menu__subTitle__delete' .  '" href="' . SITE_PATH . 'app/cms/menu_edit.php?menu_id_delete='
        . $id   . '&tbname=' . urlencode(utf8_encode($tbname)) . '&tbcode=' . urlencode(utf8_encode($value)) .  '">' . '<div class ="menu__subTitle__delete__content">  delete</div>'. '</a>'; //indica o tipo de bloco 
        $title_content = "<div class ='menu__subTitle__content'>$tbname</div>";

        $wrapper_end = "</div>";
        return $wrapper_begin . $title . $title_type    . $delete .  $title_content . $wrapper_end;

    }


    
///////////////////////////////////FETCH MENU////////////////////////////
    function fetchMenu() {


        if ($this->FP->Auth->checkLoginStatus()){  ////////////////se tiver logado////////////////
       
            if($this->getMenuTypes()){
                echo '<h1 class="menu__title">Menu</h1> ';
                $type_area = 'textarea';
                $type_one_line = "oneline"; 
                $type_add_row = 'addrow';
                $type_add_main_menu_row = 'addMainMenuRow';
                $type2 = 'Editar';
                echo  " <!--- incicio do menu Edit---> <div class='menuEdit'> ";              
                $id_menu_type = 0;
                 

                foreach ($this->menu_types as $key => $value) {
                    //echo json_encode($this->menu_types);
                    $display_value = $value;
                    $value = $this->value_to_tbname($value);
                    //echo " <br> VALUE =   $value   <br>";

                    echo $this->echo_add_main_menu_row($this->menu_name , $id_menu_type , $type_add_main_menu_row , "adicionar  tipo de prato");
                    $id_menu_type = $this->get_menu_type_id($this->menu_name , $display_value) + 0.5;
                    ///meter o titulo de cada tabela  
                    echo $this->echo_menu_subTitle($display_value,$this->get_menu_type_id($this->menu_name , $display_value) );  
                    
                    $stmt = "SELECT * FROM `$value`;" ;            ////preparar a statment     
                    //echo $stmt  ."<br>";
                    $result = $this->FP->Database->query($stmt); ///executar a statment
                    
                    if($result->num_rows != 0){
                        
                        $id_add_entry = 0;

                            echo $this-> echo_menu_addRow($value , $id_add_entry  , $type_add_row , "adicionar prato" );

                        while($row = $result->fetch_assoc()){ //enquanto estivermos a olhar pra o banco
                            
                            ////id corretos

                            $id = $row['id'];
                            $id_add_entry = $id + 0.5;
                            
                            echo  "<!--- inicio row---><div class='menuEdit__row'>";

                            $name = $row['name'];//utf8_encode($row['name']);///utd8 encode
                            $description = $row['description'];
                            $price = $row['price'];
                      
                            echo $this->echo_menu_row($value , "name" , $id  , $type_area , "Editar nome" , $name);
                            echo $this->echo_menu_row($value , "description" , $id  , $type_area , "Editar descrição" , $description);
                            echo $this->echo_menu_row($value , "price" , $id  , $type_one_line , "Editar preço" , $price);
                            echo $this->echo_menu_delete_row($value , $id , $name);
                            $content_close =   "<!--- fim de row---> </div> ";
                            echo $content_close;


                            echo $this-> echo_menu_addRow($value  , $id_add_entry  , $type_add_row , "adicionar prato" );

                        
                        }
                        
                        
                        
                       
                    }
                    else {
                        echo "You have no entries in the $display_value table <br>";
                        echo $this-> echo_menu_addRow($value  , 0  , $type_add_row , "adicionar prato" );
                    }
                }
                echo $this->echo_add_main_menu_row($this->menu_name, $id_menu_type , $type_add_main_menu_row , "adicionar  tipo de prato");
                echo "<!--- fim dp menuEdit---> </div> ";

            
            }
            else {
                //$this->create_new_main_table('menu');
                echo "You have no tables <br>";
                echo $this->echo_add_main_menu_row($this->menu_name , 0 , 'addMainMenuRow' , "adicionar  tipo de prato");
                    

            }


        
        }
        
    }
    ///////////////////////////se tiver logout /////////////////////////////////////////
    function fetchMenu2 (){ 

       
            if($this->getMenuTypes2()){
                //echo '<h1 class="menu__title">Menu</h1> ';
                if ($this->FP->Auth->checkLoginStatus()){ 
                    
                    echo  ' <!--- incicio do menu Fetch---> <div class="menuFetch" style="display: none">';  
                }
                else {
                echo '<h1 class="menu__title">Menu</h1>';
                echo  " <!--- incicio do menu Edit---> <div class='menuFetch'> ";  
                }
               
                foreach ($this->menu_types2 as $key => $value) {
                    //echo json_encode($this->menu_types);
                    //echo "key = <br>" . $value;
                    $display_value = $value;
                    $value = $this->value_to_tbname($value);
                    echo "<ul class='menuList'>      <h2 class='menuFetch__subTitle'>$display_value</h2> " ;                     ///meter o titulo de cada tabela    
                    //$value_for_tb = preg_replace('/\s+/', '_', $value);
                    $stmt = "SELECT * FROM `$value`;" ;            ////preparar a statment     
                    $result = $this->FP->Database->query($stmt); ///executar a statment
                    
                    if($result->num_rows != FALSE){
                        
                        echo  " <li class='menuList__header'>    <div class='menuFetch__items'>   ";

                        echo "  <div class='menuFetch__items__header'>"; 
                        echo "<div class='menuFetch__items__header__name'>Nome</div>";
                        echo "<div class='menuFetch__items__header__description'>Descrição</div>";
                        echo "<div class='menuFetch__items__header__price'> Preço</div>";

                        echo "</div>  </li>   ";

                        while($row = $result->fetch_assoc()){ //enquanto estivermos a olhar pra o banco
                            
                            echo "  <li  class='menuList__content'>   <div class='menuFetch__items__row'>";  

                            $id = $row['id'];
                            $name = $row['name'];
                            $description = $row['description'];
                            $price = $row['price'];  

                            $content_name = "<div class='menuFetch__items__row__name'>$name</div>";
                            $content_description = "<div class='menuFetch__items__row__description'>$description</div>";
                            $content_price = "<div class='menuFetch__items__row__price'> $price</div>";

                            echo $content_name;
                            echo $content_description;
                            echo $content_price;

                        
                            $content_close =   "</div>      </li>";
                            echo $content_close;
                        
                        }
                        
                        
                        echo " </ul>    <!---Close do menuFetch__items--->"; 
                        
                    }
                    else {
                        echo "";
                    }
                }
                echo "</div> <!---Close do menuFetch--->"; ///close do menuFetch

                
            }
            else {

                echo "";

            }

        }

   




//////////////////////Prato do Dia////////////////////////////////////




    function echo_menu_main_dish_row ( $tbname , $colname  , $type , $text , $content) {
        $edit_start = '<div class="mainDish__main__' . "$colname" . '" > <!--- incicio do menu content--->';

        $edit_type = '<a class="mainDish__main__' . "$colname" . "__type" . '" href="' . SITE_PATH . 'app/cms/upload.php?type='. $type   . '&tbname=' . urlencode(utf8_encode($tbname)) . '&tbcol=' . "$colname" . '">' . $text . '</a>'; //indica o tipo de bloco
        $edit_link = '<a class="mainDish__main__' . "$colname" . "__link" .  '" href="' . SITE_PATH . 'app/cms/upload.php?type='. $type  . '&tbname=' . urlencode(utf8_encode($tbname))   . '&tbcol=' . "$colname" . '"></a>'; //link para editar o bloco //VER VIDEO 30 PARA EDITAR O ESTILO

        $edit_end = '<!--- fim do mainDish content---> </div> ';

        $content_div = '<!--- fim do $colname---> <div class= "mainDish__main__' . "$colname" . "__content" .'" > '. "$content" . '</div>';

        

        return $edit_start . $edit_type . $edit_link . $content_div . $edit_end;
    

    }    

    function echo_menu_main_dish_row2 ($type,  $content) {
        $start = '<div class="pratoPrincipal__main__' . "$type" . '" > ' . '<div class="pratoPrincipal__main__' . "$type" . "__content".'" > ' . $content .  '</div>'  . ' <!--- incicio do menu content--->';

        
        $end = '<!--- fim do mainDish content---> </div> ';

        
        

        return $start . $end;
    

    }    

    function load_main_dish_info($tbname , $tbcol) {

        $stmt = "SELECT $tbcol FROM `$tbname`;";
        $result = $this->FP->Database->query($stmt);
        $info = $result->fetch_assoc();
        return $info["$tbcol"];
     

     
    }

    function update_main_dish_table_entry($tbname , $tbcol , $content){
        
        $stmt_update = $this->FP->Database->prepare( "UPDATE `$tbname`  SET $tbcol = ?;");
        $stmt_update->bind_param("s", $content);
		$stmt_update->execute();	
		$stmt_update->close();
        

    }
    function statusImg(){
        $stmt = "SELECT img FROM `96images`";
        $query = $this->FP->Database->query($stmt);
        if($query->num_rows > 0){   
            return true; /////se ja tiver alguma imagem no site
        }
        return false; ////////se nao tiver nenhuma imagem no site

    }




    function getImage(){
        $stmt = "SELECT img FROM `96images`";
        $query = $this->FP->Database->query($stmt);

        if($query->num_rows > 0){
            $row = $query->fetch_assoc();
            //echo json_encode($row) . "<br>";
            $imageURL = 'app/cms/uploads/'.$row["img"];
            return $imageURL;


        }
    }

    function get_main_dish_status(){
        $stmt = "SELECT `status` FROM `96images`";
        $result = $this->FP->Database->query($stmt);
        $info = $result->fetch_assoc();
        return $info["status"];

    }

    function set_main_dish_status($bool){

        if($bool == FALSE) {
            $stmt = "UPDATE `96images`  SET `status` = 0;"; 
        }
        else if($bool == TRUE) {
             $stmt = "UPDATE `96images`  SET `status` =1;";
        }
        
        $result = $this->FP->Database->query($stmt);
    }



    function echo_main_dish(){


        if($this->get_main_dish_status()){
            $title = '<h1 class="mainDish__title">' .  "Prato do Dia" . '</h1>';
            $div_begin = '<div class="mainDish__main">';
            $imageURL = $this->getImage();
            //echo $imageURL . "<br>";
            $img = '<img src="' . "$imageURL". '" alt="Fazer upload da imagem" height="400" width="400" class="mainDish__main__pic">';

            $stmt = "SELECT * FROM `96images`;" ;            ////preparar a statment do prato principal     
            //echo $stmt  ."<br>";
            $result = $this->FP->Database->query($stmt);
            $tbname = "96images";
            $type_area = 'textarea';
            $type_one_line = "oneline";
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $name = $row['name']; //utf8_encode($row['name']);///utd8 encode
                $description = $row['description'];
                $price = $row['price'];

                if($name == "" ) {
                    $name_string = $this->echo_menu_main_dish_row($tbname, "name"  , $type_area , "Editar nome" , "inserir nome do prato");
                
                }
                if($name != "" ){
                    $name_string = $this->echo_menu_main_dish_row($tbname, "name"  , $type_area , "Editar nome" , $name);
            
                }
                if( $description =="" ){
                    $description_string =  $this->echo_menu_main_dish_row($tbname , "description" , $type_area , "Editar descrição" , "inserir descrição");
            
                }
                if($description !="" ) {
                    $description_string =  $this->echo_menu_main_dish_row($tbname , "description" , $type_area , "Editar descrição" , $description);
            
                }
                if($price =="") {
                    $price_string =  $this->echo_menu_main_dish_row($tbname , "price"   , $type_one_line , "Editar preço" , "inserir preço");

                }
                if($price != "") {
                    $price_string =  $this->echo_menu_main_dish_row($tbname , "price"   , $type_one_line , "Editar preço" , $price);


                }              



            }
            else {
                
                $name_string = $this->echo_menu_main_dish_row($tbname, "name"  , $type_area , "Editar nome" , "inserir nome do prato");
                $description_string =  $this->echo_menu_main_dish_row($tbname , "description" , $type_area , "Editar descrição" , "inserir descrição");
                $price_string =  $this->echo_menu_main_dish_row($tbname , "price"   , $type_one_line , "Editar preço" , "inserir preço");


            }
        
            
            
            
            
            $div_end = '</div> <!--- fim do mainDish Main--->';

            return $title . $div_begin .$name_string . $description_string . $price_string . $img . $div_end;
        }
    }

    function echo_form() {

        if($this->get_main_dish_status()){

            $div_begin = '<div class="mainDish__form">';
            $form_begin = '<form action= "' . SITE_PATH . 'app/cms/upload.php"' . ' method="post" enctype="multipart/form-data" class="mainDish__form__upload">';
            $select = '<div class="mainDish__form__upload__text">  Selecionar imagem para Upload</div>';
            $input_file = '<input type="file" class="mainDish__form__upload__file" name="file" >';
            $input_button = '<input type="submit" name="submit" class="mainDish__form__upload__button" value="Upload">';
            $form_end = '</form>';
            $div_end = '</div > <!--- fim do mainDish Form--->';
            return $div_begin . $form_begin . $select . $input_file . $input_button . $form_end . $div_end;
        }
    }

    function fetch_prato_do_dia() {
        
        if ($this->FP->Auth->checkLoginStatus()){ 
        
            if($this->get_main_dish_status()){
                
                    $string = "Desativar o prato do dia";
            }
            else {
                
                $string = "Ativar o prato do dia";

            }

        


                echo '<button type="button" class="mainDishActivate">' . $string. '</button>';
            
                echo '<div class="mainDish">';
               
                echo $this->echo_main_dish();
                echo $this->echo_form();
                //$this->set_main_dish_status(FALSE);
                //echo $this->get_main_dish_status();
                echo ' </div> <!--- fim do mainDish--->';
                return;
        }
    }

    function fetch_prato_do_dia2(){

        if($this->get_main_dish_status()){

            if ($this->FP->Auth->checkLoginStatus()){ 

                $prato_principal = '<div class="pratoPrincipal" style="display: none">';
            }
            else {

                $prato_principal = '<div class="pratoPrincipal">';
            }

            $title = '<h1 class="pratoPrincipal__title">' .  "Prato do Dia" . '</h1>';
            $div_begin = '<div class="pratoPrincipal__main">';
            $imageURL = $this->getImage();
            
            $img = '<img src="' . "$imageURL". '" alt="Fazer upload da imagem" height="400" width="400" class="pratoPrincipal__main__pic">';

            $stmt = "SELECT * FROM `96images`;" ;            ////preparar a statment do prato principal     
            
            $result = $this->FP->Database->query($stmt);
            
            
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $name = $row['name']; //utf8_encode($row['name']);///utd8 encode
                $description = $row['description'];
                $price = $row['price'];

            
                $name_string = $this->echo_menu_main_dish_row2("name", $name);
                $description_string =  $this->echo_menu_main_dish_row2("description" ,$description);
                $price_string =  $this->echo_menu_main_dish_row2("price", $price);
            }
            
        
            
            
            
            
            $div_end = '</div> <!--- fim do pratoPrincipal Main--->';
            $div_end2 = '</div> <!--- fim do pratoPrincipal-->';

            echo  $prato_principal . $title . $div_begin .$name_string . $description_string . $price_string . $img . $div_end . $div_end2;


        }
    }





    
}
   

