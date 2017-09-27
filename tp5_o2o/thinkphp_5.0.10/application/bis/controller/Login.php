<?php
namespace app\bis\controller;
use think\Controller;
class login extends Controller
{

    public function index(){

        if(request()->isPost()){
                //登录逻辑
                //获取相关数据
                $data=input('post.');
                //通过用户名获取账户在相关信息
                //jiaoyan
                $ret=model('BisAccount')->get(['username'=>$data['username']]);
                if(!$ret||$ret->status!=1){
                    $this->error('该用户不存在或未审核');
                }
                if($ret->password!=md5($data['password'].$ret->code)){
                    $this->error('密码不正确');
                }
                model('BisAccount')->updateById(['last_login_time'=>time()],$ret->id);

                $res  =session('bisAccount', $ret,'bis');

               //var_export($_SESSION);exit();

            //保存用户信息 bis作用域

                $this->success('登录成功','index/index');
        }else{
            //获取session

            $account= session ('bisAccount','','bis');

                if($account){
                    return $this->redirect('index/index');
                }

            return $this->fetch();
        }
    }
    public function logOut(){
        //清除session
        session(null,'bis');
        $this->redirect('login/index');
    }

}