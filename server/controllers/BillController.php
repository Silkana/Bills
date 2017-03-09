<?php 
require_once 'server/controllers/MainController.php';
require_once 'server/models/Bill.php';

/**
* 
*/
class BillController extends MainController
{

	function all(){
		$bills = Bill::findAll();

		$this->data['activeLink'] = 'bills';
		$this->data['bills'] = $bills;
		$this->data['title'] = "Gens Nuls";
		// $this->data['view'] = 'bill/list.phtml';
		$this->render('bill/list.phtml');
	}

	function one(){
		if(isset($_POST['id'])){
			$bill = Bill::findById($_POST['id']);
			}
	}

	function getBillData($products){
			foreach ($products as $id => $count) {
				$dbproduct = Article::findById($id);
				$dbproduct['count'] = $count;
				//$_SESSION['msrp'] = $dbproduct['msrp']; 
				//$_SESSION['count'] = $dbproduct['count']; 
				$dbproduct['total'] = $dbproduct['msrp'] * $dbproduct['count'];
				$products[$id] = $dbproduct;
			}
			$_SESSION['info'] = $products;

			$this->data['products'] = $products;
			// $this->data['view'] = 'recap/list.phtml';
			$this->render('recap/list.phtml');

			//$_SESSION['postdata'] = $products;
			//$_SESSION['backto'] = $_SERVER['REQUEST_URI'];
	}

	function pay(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$this->data['title'] = "Payment Nul";
			$this->render('payment/list.phtml');
		}
	}

	function getBillDetail($id){
		$details = Bill::getBillDetailsUser($id);
		$this->data['billdetail'] = $details;
		$this->render('billdetails/list.phtml');

	}
}



?>