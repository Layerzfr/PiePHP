<?php
namespace src\Controller;
use Core\Controller as Controller;
Class UserController extends Controller{
	public function addAction(){
		$this->render("show");
		echo "Ceci est un ajout";
	}

	public function indexAction(){
		$this->render("index");
		echo "Et c'est l'indexAction";
	}

	public function registerAction(){
		
		$model = new \src\Model\UserModel();
		$this->render("register");
		if(isset($_POST['email']) && isset($_POST['password']) ){
			if($_POST['password'] !== '' && $_POST['email'] !== ''){
				$model->setPassword($_POST['password']);
				$model->setEmail($_POST['email']);
				$model->save();
				echo "Inscription réussie";
			}else{
				echo "Erreur pendant l'inscription..";
			}
		}
	}

	public function loginAction(){
		$model = new \src\Model\UserModel();		
		$this->render("login");
	}

	public function maintenanceAction(){
		echo "page en maintenance";
	}
}
?>