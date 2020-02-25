<?php

/*
	Template Class
	Handles all templating tasks - displaying templates, alerts & errors
*/

class Template
{
	private $data;
	private $alertTypes;
	
	/*
		Construtor
	*/
	function __construct() {
		global $FP;
        $this->FP = &$FP;
	}
	
	/*
		Functions
	*/
	function load($url)
	{
		include($url);
	}
	
	function redirect($url)
	{
		header("Location: $url");
	}
	
	/*
		Get / Set Data
	*/
	function setData($name, $value , $clean=true)
	{	
		if($clean) { 
			$this->data[$name] = htmlentities($value, ENT_QUOTES); //html entiteis converte tudo em texto
		}
		else {
			
			$this->data[$name] = $value;
		}
		
	}
	
	function getData($name)
	{
		if (isset($this->data[$name]))
		{
			
			return $this->data[$name];
		}
		else
		{
			return '';
		}
	}
	
	/*
		Get / Set Alerts
	*/
	function setAlertTypes($types)
	{
		$this->alertTypes = $types;
	}
	function setAlert($value, $type = null)
	{
		if ($type == '') { $type = $this->alertTypes[0]; }
		$_SESSION[$type][] = $value;
	}
	function getAlerts()
	{
		$data = '';
		foreach($this->alertTypes as $alert)
		{			
			if (isset($_SESSION[$alert]))
			{
				foreach($_SESSION[$alert] as $value)
				{
					
					$data .= '<li class="'. $alert .'">' . $value . '</li>';
				}
				unset($_SESSION[$alert]);
			}
		}
		return $data;
	}

	function error($type='' , $message=''){
		

		if($type == 'unauthorized') {
			$this->load(APP_PATH . 'core/views/v_unauthorized.php');
		}
		else {
			if($message != '' ) {
				$this->setData('message' , $message);
			}

			else {
				$this->setData('message', "An error has occurred. Please contact the website administrator.");
			}
			$this->load(APP_PATH . 'core/views/v_error.php');
		}
	}

	function cms_nav(){


		$sections = array( //cada array faz de secção do cms settings section
			array(
				'dashboard' => 'inactive'
			),

			array(
				'settings' => 'active',
				'change_password' => 'active'
			),
			array(
				'Clientes' => 'active',
				'Ver_Clientes' => 'active'
			)

		);


		$nav = '<ul class="fp_nav">';
		$nav .= '<li class="' . $sections[0]['dashboard'] . '">
					<a href="../dashboard/dashboard.php">Dashboard</a>
				</li>';
		$nav .= '<li class="' . $sections[1]['settings'] . '">
					<span>Settings</span>
					<ul>
						<li class="' . $sections[1]['change_password'] . '">
							<a href="../settings/password.php">Change Password</a>
						</li>
					</ul>
				</li>';
		$nav .= '<li class="' . $sections[2]['Clientes'] . '">
					<span>Clientes</span>
					<ul>
						<li class="' . $sections[2]['Ver_Clientes'] . '">
							<a href="../../app/cms/client.php">Ver Clientes</a>
						</li>
					</ul>
				</li>';	
		$nav .= '</ul>';

		echo $nav;
	}



	/////////////////////////////	CLIENTES ////////////////////////

	function checkClient($email) {
        $stmt_search = $this->FP->Database->prepare( "SELECT * FROM 96clients WHERE email = ?;");
		$stmt_search->bind_param("s" , $email);
		$stmt_search->execute();		
		$result = $stmt_search->get_result();

        if($result->num_rows > 0 ){
			$stmt_search->close();
            return true;
        }
        else {
			$stmt_search->close();
            return false;
        }
	}
	
	function delete_client($email) {
		$stmt_delete = $this->FP->Database->prepare("DELETE FROM 96clients WHERE email = ?;");
		$stmt_delete->bind_param("s", $email);
		$stmt_delete->execute();	
		$stmt_delete->close();
       
	}

    function addClient( $email , $nome) {

        if($this->checkClient($email) ) {
            return false;
        }
        else {
        $stmt_insert = $this->FP->Database->prepare("INSERT INTO 96clients ( email, nome , data) VALUES ( ? , ? , NOW() );");
		$stmt_insert->bind_param("ss", $email, $nome);
		$stmt_insert->execute();	
		$stmt_insert->close();
        return true;
        }
	}


	function echo_clients_row ( $email  , $name , $data) {
		$client_start = '<div class="clients__results__row"> <!--- incicio do clients content--->';
		
		$content_email = "<div class='clients__results__row__email'>$email</div>";
        $content_name = "<div class='clients__results__row__name'>$name</div>";
		$content_data = "<div class='clients__results__row__data'> $data</div>";
		
		$delete_start = '<div class="clients__results__row__delete"> <!--- incicio do menu content--->';

        $delete_link = '<a class="clients__results__row__delete__link' .  '" href="' . SITE_PATH . 'app/cms/client.php?email_delete='
		.  urlencode(utf8_encode($email))  .  '">'
		. ' <div class="clients__results__row__delete__link__content"> <span class="clients__results__row__delete__link__content__p"> delete</span> </div>'. '</a>'; 
       

		$delete_end = '<!--- fim do clients delete content---> </div> ';

        $client_end = '<!--- fim do clients content---> </div> ';


        

        return  $client_start . $content_email. $content_name  . $content_data . $delete_start . $delete_link . $delete_end . $client_end;
       

    }
	
	function fetchClients() {

		$stmt_search ="SELECT * FROM 96clients;";
		$result = $this->FP->Database->query($stmt_search);

		if($result->num_rows != 0){ 

			echo '<div class="clients"> <!--- incicio do clients --->';
			echo '<div class="clients__header">';

			echo '<h2 class="clients__header__head2"> Clientes</h2>';
			echo "<div class='clients__header__email'>Email</div>";
            echo "<div class='clients__header__nome'>Nome</div>";
            echo "<div class='clients__header__data'> Data</div>"; 
			
			echo '</div>  <!--- fim do header--->';

			echo '<div class="clients__results"> <!--- incicio do clients results --->';


			while($row = $result->fetch_assoc()){ 

				$email = $row['email'];//utf8_encode($row['name']);///utd8 encode
				$name = $row['nome'];//utf8_encode($row['name']);///utd8 encode
				$data =  $row['data'];

				echo $this->echo_clients_row ( $email  , $name , $data) ;



			}
			echo '</div> <!--- fim do clients result --->';
			echo '</div> <!--- fim do clients --->';
		}

	}

	
}

