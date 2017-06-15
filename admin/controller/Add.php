<?php
namespace app\admin\controller;
header("Content-type: text/html; charset=utf-8"); 
use think\Controller;
class Add extends Controller
{
    public function index()
    {
        return $this->fetch('add');
    }
    public function add()
    {
    	if(request()->isPost()){
    		dump(input('post.'));
    		return;
    	}
        return $this->fetch();
    }


}