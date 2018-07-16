<?php
namespace Core;
class Core {
	private $Controller;
	
	public function run() {
		include "Controller.php";
		$router = new \Router();
		$routes = $router->get($_SERVER['REQUEST_URI']);
		
		
		if($routes !== false){
			$this->Controller = "/src/Controller/" . ucfirst($routes['controller']) . "Controller";
			$this->Controller = str_replace("/", "\\", $this->Controller);
			$actual = new $this->Controller();
			$action = $routes['action'] . "Action";
			if(method_exists($this->Controller, $action)){
				$actual->$action();
			}else{
				include "src/View/Error/404.php";
			}
		}else {
            $uriArray = explode("/",$_SERVER['REQUEST_URI']);
            $path = str_replace("/", "\\", "/src/Controller/");

            if (file_exists("src/Controller/".ucfirst($uriArray[1])."Controller.php")){
                $class = $path.ucfirst($uriArray[1])."Controller";
                $controller = new $class();

                if(!isset($uriArray[2]) || $uriArray[2] == ""){
                    $controller->indexAction();
                }

                else if(method_exists("src\Controller\UserController", $uriArray[2]."Action")){
                    $action = $uriArray[2]."Action";
                    $controller->$action();
                }

                else {
                    include "src/View/Error/404.php";
                }
            }

            elseif($uriArray[1] == ""){
                return false;
            }

            else {
                include "src/View/Error/404.php";
            }
        }
		echo __CLASS__ . " [OK]" . PHP_EOL;
	}
}