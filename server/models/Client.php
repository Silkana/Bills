<?php 

require_once 'Model.php';
require_once 'server/classes/Roles.php';

class Client extends Model {    
	public static $table = 'client';
    function __construct() {

    }

    // public static function profile(){
    	
    // }

    public static function findByEmail($email, $fields = '*') {
		$client = DatabaseManager::execute('SELECT '.$fields.' FROM `'. static::$table . '`'
			. " WHERE mail = :email", [ 'email' => $email ], false);


		if(is_array($client) && isset($client['roles'])){
			$client['roles'] = unserialize($client['roles']);	
			return $client;
		}

		return false;

	}

	public static function insert($email, $password, $role){
		if(is_null($role)) $role = serialize([Role::USER]);
		$error = DatabaseManager::executenodisplay(
			"INSERT INTO `client`( `mail`, `password`, `roles` )". 
			"VALUES (:email , :password, :role)", 
			[ 
				'email' => $email, 
				'password' => $password, 
				'role' => $role
			]);

		return $error;
	}
}




?>