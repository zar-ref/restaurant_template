<?php 


/* Auth object */




class Auth {


    private $salt = "rvgnbil6";

    // Construct

    function __construct(){
        
    }




    function validateLogin($user , $pass) {

        global $FP; //vai buscar a variavel global $FP de init.php que vai ser incluida através do init.php logo consegue-se buscar a variavel $database de database.php 
        $userPass =  md5($pass . $this->salt);
        ///create a query para ver se temos o user na BD
        if( $stmt = $FP->Database->prepare("SELECT * FROM users WHERE username = ? AND password = ?")) {
           
            $stmt->bind_param("ss" , $user ,  $userPass); //ligar os parametros com md5 para encriptar
            $stmt->execute();
            $stmt->store_result();
            
            //ver ses tem alguma linha com user
            if($stmt->num_rows > 0) {
                //success
                $stmt->close();
                return true;
            }
            else {
                //failure
                $stmt->close();
                return false;
            }
        }

        else {
            die("ERROR: Could not prepare statement");
        }
    }


    function checkLoginStatus() {
        if( isset($_SESSION['loggedin'])) {
            return true;    
        }
        else {
            return false;
        }

    }

    function getCurrentUserName()
	{
		return $_SESSION['username'];
	}

    function checkAuthorization() {

        global $FP;
        if($this->checkLoginStatus() == false){
            $FP->Template->error('unauthorized');
            exit;
        }
    }

    	
	function getSalt()
	{
		return $this->salt;
	}



    function logout() {
        session_destroy();
        session_start();


    }
}
