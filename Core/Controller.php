<?php
namespace Core;
class Controller{

	private static $_render;

	public function __construct(){
		new \Core\Request();
	}
	
	protected function render($view, $scope = []) {
		$f = implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', str_replace('Controller', '', basename(get_class($this))), $view]) . '.php';
		$f = str_replace("\\", "/", $f);
		if (file_exists($f)) {
			ob_start();
			include($f);
			$view = ob_get_clean();
			ob_start();
			include(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', 'index']) . '.php');
			echo self::$_render = ob_get_clean();
		}
	}
}
?>