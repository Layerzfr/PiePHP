<?php
namespace Core;
Class Request{

    public function __construct(){
        $_POST = array_map('stripslashes', $_POST);
        $_POST = array_map('trim', $_POST);
        $_POST = array_map('htmlspecialchars', $_POST);
        $_GET = array_map('stripslashes', $_GET);
        $_GET = array_map('trim', $_GET);
        $_GET = array_map('htmlspecialchars', $_GET);
    }
}

?>