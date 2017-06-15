<?php
namespace app\index\controller;
header("Content-type: text/html; charset=utf-8"); 
use think\Controller;
class Color extends Controller
{
    public function index()
    {
        return $this->fetch('color');
    }

}