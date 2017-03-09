<?php

class DatabaseManager {
	private static $pdo;
	private static function getPdo() {
		if(isset(self::$pdo)){
			return self::$pdo;
		}

		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='. DB_NAME , DB_USER , DB_PASSWORD);

		$pdo->exec('SET NAMES UTF8');

		self::$pdo = $pdo; 
		
		return $pdo;
	}

	public static function execute($sql, $args=[], $fetchAll = true){
		$pdo = self::getPdo();
		$query = $pdo->prepare($sql);
		$query->execute($args);

		if ($fetchAll == true) {
			return $query->fetchAll(PDO::FETCH_ASSOC);		
		}else{
			return $query->fetch(PDO::FETCH_ASSOC);
		}
	}

	public static function executenodisplay($sql, $args=[]){
		$pdo = self::getPdo();
		$query = $pdo->prepare($sql);
		$query->execute($args);
		return $query->errorInfo();
	}

	public static function getlastbillid(){
		$pdo = self::getPdo();
		$billId = $pdo->lastInsertId();
		return $billId;
	}
}

 ?>