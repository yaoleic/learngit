<?php
 namespace app\common\model;
 use think\Model;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/6
 * Time: 17:51
 */
class Order extends BaseModel
{
    public function add($data)
    {
        $data['status']=1;
        $this->save($data);
        return $this->id;
    }
}