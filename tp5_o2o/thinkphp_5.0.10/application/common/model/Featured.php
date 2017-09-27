<?php
namespace app\common\model;
use think\model;
class Featured extends BaseModel{
    public function getFeaturedsByType($type){
        $type=[
            'type'=>$type,
            'status'=>['neq',-1],
        ];
        $order=[
            'id'=>'desc',
        ];
        $result =$this->where($type)
            ->order($order)
            ->paginate();
        return $result;
    }
}