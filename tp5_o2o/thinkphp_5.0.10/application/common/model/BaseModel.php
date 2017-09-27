<?php
 namespace app\common\model;
 use think\Model;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/6
 * Time: 17:51
 */
class BaseModel extends model
{       protected $autoWriteTimestamp=true;
        public function add($data){
            $data['status']=0;
           // $data['create_time']=time();
            $this->save($data);
           return $this->id;
        }
        public function updateById($data,$id){
            return $this->allowField(true)->save($data,['id'=>$id]);
        }
}