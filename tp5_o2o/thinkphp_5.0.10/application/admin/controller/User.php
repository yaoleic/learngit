<?php
namespace app\admin\controller;
use think\Controller;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/6
 * Time: 18:50
 */
class User extends Base {
    private $obj;
 public function _initialize()
 {
    $this->obj=model('User');
 }
    public function index() {
        $user=$this->obj->getUserByStatus(1);

        return $this->fetch('', [
            'user'=>$user,
        ]);
    }
    public function dellist() {
        $user=$this->obj->getUserByStatus(-1);

        return $this->fetch('', [
            'user'=>$user,
        ]);
    }
    public function status(){
        $data = input('get.');
        $res = $this->obj->save(['status'=>$data['status']],['id'=>$data['id']]);
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