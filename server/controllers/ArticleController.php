<?php 
require_once 'server/controllers/MainController.php';
require_once 'server/models/Article.php';
/**
* 
*/
class ArticleController extends MainController
{
	
	function all(){

		$articles = Article::findAll();

				$this->data['activeLink'] = 'articles';
				$this->data['articles'] = $articles;
				
				$this->data['title'] = "Gens Nuls";
				// $this->data['view'] = 'article/list.phtml';
				$this->render('article/list.phtml');
	}
}

	// function one(){
	// 	if(isset($_POST['id'])){
	// 		$client = Article::findById($_POST['id']);
	// 		}
	// } 
?>