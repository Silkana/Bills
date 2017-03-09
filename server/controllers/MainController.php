<?php 
require_once 'server/classes/Roles.php';
require_once 'server/classes/Flashbag.php';
/**
*/
class MainController
{

	protected $data = [
		'activeLink' => '',
		'view' => 'commons/default.phtml',
		'title' => 'Home'
	];

	protected $path = FRONT_PATH;
	public function __construct(){
		//$this->isAdmin = $isAdmin;
		$this->flash_bag = new Flashbag();
	}

	public function render($view = "commons/default.phtml"){
		$this->data['view'] = $view;
		include VIEWS_PATH . 'layout.phtml';
	}

	public function forbidden(){
		$this->data['title'] = 'Access Not Allowed';
		$this->render('errors/forbidden.phtml');
	}

	// function __destruct(){

	// 	if(self::isAdmin() == true) {
	// 		$this->path = ADMIN_PATH;
	// 	} else if(self::isUser() == true) {
	// 		$this->path = USER_PATH;
	// 	}
	// 	include $this->path . 'layout.phtml';
	//  include FRONT_PATH . 'layout.phtml';
	// }

	public static function redirect($path){
		header('Location:'.$path);
	}

	public static function isAdmin(){
		return isset($_SESSION['roles']) && $_SESSION['roles'] && in_array(Role::ADMIN, $_SESSION['roles']);
	}

	public static function isUser(){
		return isset($_SESSION['roles']) && $_SESSION['roles'] && in_array(Role::USER, $_SESSION['roles']);
	}

	public static function getBasePath(){
		if(self::isAdmin() == true){
			return "/admin";
		}else if(self::isUser() == true){
			return "/user";
		}else{

			return '/';
		}
	}
}


 ?>