<?php 

require_once 'server/controllers/MainController.php';

session_start();

if(isset($_GET["method"])){

	$arr = explode(DIRECTORY_SEPARATOR, $_GET["method"]);

	switch($arr[0]){

		case 'admin':
			include_once 'routers/admin.php';
		break;

		case 'user':
			include_once 'routers/user.php';
		break;

		case 'front':
			include_once 'routers/front.php';
		break;

		default: 
			include_once 'routers/front.php';

	}
}

 ?>