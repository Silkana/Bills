<?php 

require_once 'Model.php';

class Bill extends Model {    
	public static $table = 'bill';


public static function insertBillDetails($article_id_fk, $bill_id_fk, $ordered_quantity, $vat, $unit_price){
	$vat = 20;

	$billDetailsInsert = DatabaseManager::executenodisplay(
			"INSERT INTO `bill_details`( `article_id_fk`, `bill_id_fk`, `ordered_quantity`, `vat`, `unit_price` )". 
			"VALUES (:article_id_fk , :bill_id_fk, :ordered_quantity, :vat, :unit_price)", 
			[ 
				'article_id_fk' => $article_id_fk, 
				'bill_id_fk' => $bill_id_fk, 
				'ordered_quantity' => $ordered_quantity,
				'vat' => $vat,
				'unit_price' => $unit_price,
			]);

	return $billDetailsInsert;
}


public static function insertBill($creation_date, $payment_date, $client_id){
	$billInsert = DatabaseManager::executenodisplay(
			"INSERT INTO `bill`( `creation_date`, `payment_date`, `client_id` )". 
			"VALUES (:creation_date, :payment_date, :client_id)", 
			[ 
				'creation_date' => $creation_date, 
				'payment_date' => $payment_date,
				'client_id' => $client_id
			]);

	return $billInsert;
}

public static function getBillDetails($id){
	$getBillDetails = DatabaseManager::execute(
		"SELECT * FROM bill b INNER JOIN bill_details bd ON b.id = bd.bill_id_fk INNER JOIN article a ON a.id = bd.article_id_fk INNER JOIN client c ON b.client_id = c.id WHERE bill_id_fk = :id", [ 'id' => $id ]
	);
	return $getBillDetails;
}

public static function getBillDetailsUser($id){
	$getBillDetailsUser = DatabaseManager::execute(
		"SELECT * FROM bill b INNER JOIN bill_details bd ON b.id = bd.bill_id_fk INNER JOIN article a ON a.id = bd.article_id_fk INNER JOIN client c ON b.client_id = c.id WHERE client_id = :id", [ 'id' => $id ]
	);
	return $getBillDetailsUser;
}











}


	?>