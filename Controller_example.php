<?php
class Controller{
	public function show(){
		$data = Model::getData();//invoking the class the static function named getData() in class Model
		echo View::display($data);//invoking the class the static function named display() in class View
	}
}