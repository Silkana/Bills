<?php 

require_once 'Model.php';

class Article extends Model {    
	public static $table = 'article';

	// public static function getStock($fields){

	// $stock = DatabaseManager::execute('SELECT '.$fields.' FROM `'. static::$table . '`'
	// 		. " WHERE name = :name", [ 'name' => $name],
	// 		. " WHERE quantity = :quantity", [ 'quantity' => $quantity],
	// 		. " WHERE id = :id", [ 'id' => $id]; 
	// 		);
	// }

	public static function updateQuantity($articleId, $count){
		$result = DatabaseManager::execute("UPDATE article SET quantity = quantity - :count WHERE id = :id",
		['count' => $count,  'id' => $articleId]);
	return $result;
	}

	public static function restock($articleId, $count){
		$result = DatabaseManager::execute("UPDATE article SET quantity = quantity + :count WHERE id = :id",
		['count' => $count,  'id' => $articleId]);
	return $result;
	}
}



?>