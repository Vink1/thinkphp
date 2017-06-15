<?php
namespace app\admin\controller;
header("Content-type: text/html; charset=utf-8"); 
use think\Controller;
use think\Db;#也可以使用助手函数
use app\admin\model\Admin as AdminModel;
class Admin extends Controller
{
    public function lst()
    {
        $list = AdminModel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function add()
    {
    	if(request()->isPost()){
    		$data = [
    			'username' =>input('username'),
    			'password' =>md5(input('password')),
    		];
    		if(Db::name('admin')
    			->insert($data)) #该判断语句可以改为db('admin')->insert($data),可以达到同样的效果
    		{
    			return $this->success('添加管理员成功','lst');
    		}else{
    			return $this->error('添加管理员失败！');
    		}
    		return;
    	}
        return $this->fetch();
    }
    public function edit(){
        $id = input('id');
        $admins=db('admin')->find($id);
        if(request()->isPost()){
            $data = [
            'id' => input('id'),
            'username' => input('username'),
            ];
            if(input('password')){
                $data['password']=md5(input('password'));
            }else{
                $data['password']=$admins['password'];
            }
            $validate = \think\Loader::validate('Admin');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());die;
            }
            if(db('admin')->update($data)){
                $this->success('修改管理员信息成功！','lst');
            }else{
                $this->error('修改管理员信息失败！');
            }
            return;

        }

        $this->assign('admins',$admins);
        return $this->fetch('edit');
    }
    public function del(){
        $id=input('id');
        if($id !=2){
            if(db('admin')->delete(input('id'))){
                $this->success('删除管理员成功！','lst');
            }else{
                $this->error('删除管理员失败！');
            }
        }else{
            $this->error('初始管理员不能删除');
        }
    }

}