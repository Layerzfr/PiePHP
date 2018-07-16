<?php
namespace src\Controller;
use Core\Controller as Controller;
Class AppController extends Controller{
	public function indexAction(){
		$this->render("index");
		echo "Ceci est l'indexAction de l'AppController";
	}
}
?>