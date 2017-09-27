<?php
namespace app\admin\controller;
use think\Controller;
class Base extends Controller{
    public $account;
    public function _initialize()
    {
        //判断用户是否登录
        $isLogin=$this->isLogin();
        if(!$isLogin){
            $this->redirect('login/index');
        }
    }
    //判断是否登录
    public function isLogin(){
        //获取session
        $user=$this->getLoginUser();
        if($user && $user->id){
            return true;
        }
        return false;
    }
    public function getLoginUser(){

        if(!$this->account) {
            $this->account = session('admin', '', 'admin');
        }
        return $this->account;
    }
    public function status(){
        $data = input('get.');
        $model=request()->controller();
        $res = model($model)->save(['status'=>$data['status']],['id'=>$data['id']]);
        if($res){
            /*
             * status -1 删除 1 成功
             * */
            $this->success('状态更新成功');
        }else{
            $this->error('状态更新失败');
        }

    }

}