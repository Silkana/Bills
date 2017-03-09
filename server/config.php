<?php 

	define('DB_HOST', 'localhost');
	define('DB_PASSWORD', 'bills');
	define('DB_USER', 'Bills');
	define('DB_NAME', 'Bills');
	// define('HOST_URL', 'http://restaurant.local');
	define('HOST_URL', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']);

	define('VIEWS_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
	
	define('ADMIN_PATH', VIEWS_PATH . 'admin' . DIRECTORY_SEPARATOR);
	define('FRONT_PATH', VIEWS_PATH . 'front' . DIRECTORY_SEPARATOR);
	define('USER_PATH', VIEWS_PATH . 'user' . DIRECTORY_SEPARATOR);

	//define('ASSETS_PATH', '/assets' . DIRECTORY_SEPARATOR);

	define('ASSETS_PATH', HOST_URL.'/assets/');
 ?>