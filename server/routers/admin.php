<?php 

// ADMIN ZONE

if (!MainController::isAdmin()){return MainController::redirect("/forbidden");}

//admin/article
$path = (isset($arr[1])) ? $arr[1] : '';

// if(isset($arr[1])){
// 	$path = $arr[1];
// } else {
// 	$path = "";
// }

switch($path) {

	case "clients":
		include_once "server/controllers/ClientController.php";
		$clients_controller = new ClientController();
		$clients_controller->all();
	break;


	case "client":
		include_once "server/controllers/ClientController.php";
		if(isset($_POST['id'])){
			$client_controller = new ClientController();
			//$client_controller->one($id);
		}
	break;







	case "bills":
		include_once "server/controllers/BillController.php";
		$bills_controller = new BillController();
		$bills_controller->all();
	break;


	case "bill":
		include_once "server/controllers/BillController.php";
		$bill_controller = new BillController();
		$bill_controller->one();
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


	case "logout":
		session_destroy();
		MainController::redirect('/');
	break;

	default:
		include_once "server/controllers/MainController.php";
		$mc = new MainController();
		$mc->render();

}


 ?>