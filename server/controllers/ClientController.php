<?php 

require_once 'server/controllers/MainController.php';
require_once 'server/models/Client.php';
require_once 'server/classes/Roles.php';
require_once 'server/classes/Validate.php';
require_once 'server/models/Model.php';


/**
* 
*/

class ClientController extends MainController
{




	function all(){

		$clients = Client::findAll();
		$this->data['activeLink'] = 'clients';
		$this->data['clients'] = $clients;
		$this->data['title'] = "Gens Nuls";
		// $this->data['view'] = 'client/list.phtml';
		$this->render('client/list.phtml');
	}

	function one($id){
	
		$client = Client::findById($id);

		$this->data['client'] = $client;
		$this->data['title'] = "Gens Nuls";
		// $this->data['view'] = 'client/list.phtml';
		$this->render('client/list.phtml');
	}

	function profile(){
		$id = $_SESSION['id'];
		$client = Client::findById($id);

		$this->data['activeLink'] = 'profile';
		$this->data['client'] = $client;
		$this->data['title'] = "Profil Nul";
		// $this->data['view'] = 'profile/list.phtml';
		$this->render('profile/list.phtml');
	}

	function login($email, $password){
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$this->data['activeLink'] = 'login';
			$this->data['title'] = "Login";
			// $this->data['view'] = 'login.phtml';
			$this->render('login.phtml');
		}else{
			

			$client = Client::findByEmail($email,'id, password, roles');
			if($client == true){

				if(strcasecmp(hash('sha512',$password), $client['password']) === 0){

					$_SESSION['roles'] = $client['roles'];
					$_SESSION['id'] = $client['id'];

					$path = self::getBasePath();
					if(isset($_SESSION['backto'])){
						$path = $_SESSION['backto'];
						unset($_SESSION['backto']);
					}
					self::redirect($path);					
				}		 
			}else{ 
			}
			
		}
	}

	function register($email, $password){
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$this->data['activeLink'] = 'register';
			$this->data['title'] = "Register";
			// $this->data['view'] = 'register.phtml';
			$this->render('register.phtml');
		}else{
			//$passwordunclean = $_POST['password'];
			//$password = hash('sha512',$passwordunclean);
			
			// $passwordtest = hash('sha512',$_POST['confirmpassword']);
			//$email = $_POST['email'];

			if(isset($email) && isset($password)){
				$password = hash('sha512', $password);
				Client::insert($email, $password, serialize([Role::USER]));
					

				$path = self::getBasePath();
				if(isset($_SESSION['backto'])){
					$path = $_SESSION['backto'];
					unset($_SESSION['backto']);
				}
				self::redirect($path);					
			}
		}
	}
}

?>