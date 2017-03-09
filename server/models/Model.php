<?php 

require_once "server/classes/DatabaseManager.php";

class Model {

	public static function findById($id2) {
		$result = DatabaseManager::execute("SELECT * FROM `" . static::$table."`".
			" WHERE id = :id1", ['id1' => $id2], false);
		return $result;
	}

	public static function findAll() {
		$result = DatabaseManager::execute("SELECT * FROM `" . static::$table."`");
		return $result;
	}

	public static function select($table, $fields = '*') {
		return DatabaseManager::execute('SELECT '.$fields.' FROM `'. $table . '`');
	}


}
 ?>