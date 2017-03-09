<?php 

// FREE ZONE

switch($arr[0]) {

	case "login":
		include_once "server/controllers/ClientController.php";
		include_once "server/classes/Validate.php";
		$clients_controller = new ClientController();

		if (isset($_POST['email'], $_POST["password"])){
			$email = $_POST["email"];
			$password = $_POST["password"];

			// die("ok");

			// $email = Validate::validEmail($email);
			// $password = Validate::validPassword($password);

			if(Validate::email($email) && Validate::password($password)){

				$validLogin = $clients_controller->login($email, $password);

			}
		}else{
			$clients_controller->login('' , '');
		}
	break;

	case 'payment':
		include_once "server/controllers/BillController.php";
		$bill_controller = new BillController();
		$bill_controller->pay();
	break;


	case 'paid':
		include_once "server/controllers/MainController.php";
		include_once "server/classes/DatabaseManager.php";
		include_once "server/models/Bill.php";
		include_once "server/models/Article.php";

		
		$arrInfo = $_SESSION['info'];

		$vat = 20;


		Bill::insertBill(date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), $_SESSION['id']);
		$billId = DatabaseManager::getlastbillid();
		

		foreach ($arrInfo as $key => $value){
			
			$count = $value['count'];
			$articleId = $value['id'];
			$price = $value['msrp'];


			Bill::insertBillDetails($articleId, $billId, $count , $vat, $price);
			Article::updateQuantity($articleId, $count);
		}

		$mainController = new MainController();
		$mainController->render('/paid/list.phtml');
		
	break;


	case "register":
		include_once "server/controllers/ClientController.php";
		include_once "server/classes/Validate.php";
		require_once 'server/models/Client.php';
		$clients_controller = new ClientController();

		if(isset($_POST['password'], $_POST['confirmpassword'], $_POST['email'])) {
				// Client::insert($email, $password);
			$password = $_POST['password'];
			$email = $_POST['email'];
			$passwordtest = $_POST['confirmpassword'];
			
			Validate::email($email);
			Validate::password($password);

			if($password == $passwordtest){	
				$clients_controller->register($email, $password);
			}
		}else{
			$clients_controller->register('' , '');
		}
	break;

	case 'recap':
		include_once "server/controllers/MainController.php";
		include_once "server/controllers/ArticleController.php";
		include_once "server/controllers/ClientController.php";
		include_once "server/controllers/BillController.php";
		if(MainController::isAdmin() || MainController::isUser()){
			if (isset($_POST['products'])) {
				$products = $_POST['products'];
				$bc = new BillController();
				$bc->getBillData($products);

				echo('i was here');

			}else if(isset($_SESSION['postdata'])) {
				$products = $_SESSION['postdata'];
				$bc = new BillController();
				$bc->getBillData($products);

				echo("i wasn't here");
			}	
		}else{

			$products = $_POST['products'];
			$_SESSION['postdata'] = $products;
			$_SESSION['backto'] = $_SERVER['REQUEST_URI'];
			MainController::redirect('/login');
		}
		
	break;

	case "articles":
		include_once "server/controllers/ArticleController.php";
		$articles_controller = new ArticleController();
		$articles_controller->all();
	break;


	case "article":
		include_once "server/controllers/ArticleController.php";
		$article_controller = new ArticleController();
		$article_controller->one();
	break;

	// case "login":
	// 	include_once "server/controllers/ClientController.php";
	// 	$clients_controller = new ClientController();
	// 	$clients_controller->login();
	// break;

	case "forbidden":
		$mc = new MainController();
		$mc->forbidden();
	break;

	default:
		include_once "server/controllers/MainController.php";
		$mainController = new MainController();
		$mainController->render();
}


 ?>