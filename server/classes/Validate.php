<?php 

require_once 'server/classes/Flashbag.php';

class Validate
{

	public static function email($email){

		$v_email = htmlspecialchars($email);
		$v_email = strip_tags($v_email);
		
		$v_email = filter_var($v_email, FILTER_VALIDATE_EMAIL);

		if ($v_email && strcasecmp($email, $v_email) === 0){
			return $email;
		}


		return false;

	}


	public static function password($password){

		$v_password = htmlspecialchars($password);
		$v_password = strip_tags($v_password);

		if ($v_password && strcasecmp($password, $v_password) === 0){
			return $password;
		}

		return false;

	}

	public static function id($id)
	{
		if((!is_int(intval($id)) && intval($id) == $id) || $id < 1) throw new Exception("Error Processing Request", 1);
		return $id;
	}
}








?>