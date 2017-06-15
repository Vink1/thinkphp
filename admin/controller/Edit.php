<?php
namespace app\admin\controller;
header("Content-type: text/html; charset=utf-8"); 
use think\Controller;
class Edit extends Controller
{
    public function index()
    {
        return $this->fetch('edit');
    }

}