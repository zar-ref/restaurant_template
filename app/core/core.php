<?php



//core flightpath class



class FlightPath_Core {

    public $Template , $Auth , $Database , $Cms ,$Menu , $Dashboard;

    function __construct($server , $user , $pass , $db) {
        //create database connection
        $this->Database = new mysqli($server , $user , $pass , $db);
        if($this->Database->connect_error) {

            echo "Erro: " . $this->Database->connect_error;
        }
        //create template object
        
        include( APP_PATH . "core/models/m_template.php"); //como temos q incluir com views vai.-se referenciar a pasta principal
        $this->Template = new Template();
        //set alert types
        $this->Template->setAlertTypes( array('success' , 'warning' , 'error'));
        

        //auth object
        include( APP_PATH . "core/models/m_auth.php"); //como temos q incluir com views vai.-se referenciar a pasta principal
        $this->Auth = new Auth();

        //create cms objecy
        include( APP_PATH . "cms/models/m_cms.php"); //como temos q incluir com views vai.-se referenciar a pasta principal
        $this->Cms = new Cms();

        //criar menu object
        include( APP_PATH . "cms/models/m_menu.php"); //como temos q incluir com views vai.-se referenciar a pasta principal
        $this->Menu = new Menu();

        




        ///start session
        session_start();
        

    }

    function __destruct( ) {

        $this->Database->close();
    }

    function head() { //incluir o js e css necessario para o cms correr
        if($this->Auth->checkLoginStatus()) {
            include(APP_PATH . "core/templates/t_head.php");

        }
        if (isset($_GET['login']) &&  $this->Auth->checkLoginStatus() == false ) {
            include(APP_PATH . "core/templates/t_login.php");
           
           
        }
    }

    function body_class() { //acrescetar a classe fp_editing ao body element no index.php
        if($this->Auth->checkLoginStatus()) {
           echo " fp_editing";

        }

    }

    function toolbar() {
        if($this->Auth->checkLoginStatus()) {
           include(APP_PATH . "core/templates/t_toolbar.php");
 
         }

    }

    
    function toolbar2() {
        if($this->Auth->checkLoginStatus()) {
           include(APP_PATH . "core/templates/t_toolbar2.php");
 
         }

    }





    function login_link() {
        if($this->Auth->checkLoginStatus()) {
            echo "<a href='" . SITE_PATH . "app/logout.php'> Logout </a>";
        }
        else {
            echo "<a href='?login'>Login</a>";
        }
    }

    
}









