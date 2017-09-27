<?php
 namespace app\common\model;
 use think\Model;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/6
 * Time: 17:51
 */
class User extends BaseModel
{      public function add($data=[])
{
    //如果提交的数据不是数组
    if(!is_array($data)){
        exception('传递的数据不是数组');
    }
    $data['status']=1;
    return $this->allowField(true)->save($data);
}

    //根据用户名获取用户信息
      public function  getUserByUsername($username){
        if(!$username){
            exception('用户名不合法');
        }
        $data=['username'=>$username
        ];
        return $this->where($data)->find();

      }
      public function getUserByStatus($status=0){
          $data=[
          'status'=>$status,
          ];
          $order=[
              'listorder'=>'desc',
              'id'=>'desc',
          ];
        $result=$this->where($data)->order($order)->paginate();
        return $result;
      }

}