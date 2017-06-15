<?php
namespace app\admin\controller;
header("Content-type: text/html; charset=utf-8"); 
use think\Controller;
use think\Db;#也可以使用助手函数
use app\admin\model\Link as LinkModel;
class Link extends Controller
{
    public function lst()
    {
        $list = LinkModel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function add()
    {
    	if(request()->isPost()){
    		$data = [
    			'title' =>input('title'),
    			'url' =>input('url'),
                'desc' =>input('desc'),
    		];
            $validate = \think\Loader::validate('link');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());die;
            }
    		if(Db::name('Link')
    			->insert($data)) #该判断语句可以改为db('admin')->insert($data),可以达到同样的效果
    		{
    			return $this->success('添加友情链接成功','lst');
    		}else{
    			return $this->error('添加友情链接失败！');
    		}
    		return;
    	}
        return $this->fetch();
    }
    public function edit(){
        $id = input('id');
        $link=db('link')->find($id);
        if(request()->isPost()){
            $data = [
            'id'=>input('id'),
            'title' => input('title'),
            'url' => input('url'),
            'desc' => input('desc'),
            ];
            $validate = \think\Loader::validate('Link');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());die;
            }
            if(db('link')->update($data)){
                $this->success('修改友情链接成功！','lst');
            }else{
                $this->error('修改友情链接失败！');
            }
            return;

        }

        $this->assign('link',$link);
        return $this->fetch('edit');
    }
    public function del(){
        $id=input('id');
        if(db('link')->delete(input('id'))){
            $this->success('删除友情链接成功！','lst');
        }else{
            $this->error('删除友情链接失败！');
        }
    }
}