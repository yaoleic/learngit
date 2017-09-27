<?php
 namespace app\common\model;
 use think\Model;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/6
 * Time: 17:51
 */
class BisAccount extends BaseModel
{
    public function updateById($data,$id){
        //allowFiled过滤数组中飞数据表中的数据

        return $this->allowField(true)->save($data,['id'=>$id]);
    }
}