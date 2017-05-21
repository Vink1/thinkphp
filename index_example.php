<?php
require_once('Model.php'); //invoking the Model class
require_once('View.php'); //invoking the View class
require_once('Controller.php'); //invoking the Controller class

$c = $_GET['c'];//gain the parameter 'c' in URL then transfer to the Controller
$a = $_GET['a'];//gain the parameter 'a' in URL then transfer to the method in Controller

$controller = new $c; //Creating an object 
$controller -> $a();//invoking the objection method