<?php 

// ADMIN ZONE
if (!MainController::isUser() && !MainController::isAdmin()){return MainController::redirect('/forbidden');}
//admin/article
$path = (isset($arr[1])) ? $arr[1] :$arr[0];

// if(isset($arr[1])){
// 	$path = $arr[1];
// } else {
// 	$path = "";
// }

switch($path) {

	case "profile":	
	include_once "server/controllers/ClientController.php";
			$client_controller = new ClientController();
			$client_controller->profile();
	break;

	case "billdetails":
		include_once "server/controllers/BillController.php";
		include_once "server/classes/Validate.php";
		if(isset($_GET['id']) && $id = Validate::id($_GET['id'])){
			$bills_controller = new BillController();
			$bills_controller->getBillDetail($id);
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
		$mainController = new MainController();
		$mainController->render();

}


 ?>