<?php
namespace app\admin\controller;
use think\Controller;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/6
 * Time: 18:50
 */
class Login extends Controller {
    public function index(){

        if(request()->isPost()){
            //登录逻辑
            //获取相关数据
            $data=input('post.');
            //通过用户名获取账户在相关信息
            //jiaoyan
            $ret=model('Admin')->get(['username'=>$data['username']]);
            if(!$ret||$ret->status!=1){
                $this->error('该用户不存在或未审核');
            }
            if($ret->password!=$data['password']){
                $this->error('密码不正确');
            }
            model('admin')->updateById(['last_login_time'=>time()],$ret->id);

            $res  =session('admin', $ret,'admin');

            //var_export($_SESSION);exit();

            //保存用户信息 bis作用域

            $this->success('登录成功','index/index');
        }else{
            //获取session

            $account= session ('admin','','admin');

            if($account){
                return $this->redirect('index/index');
            }

            return $this->fetch();
        }
    }
    public function logOut(){
        //清除session
        session(null,'admin');
        $this->redirect('login/index');
    }

}