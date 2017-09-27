<?php
 namespace app\common\model;
 use think\Model;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/6
 * Time: 17:51
 */
class Bis extends BaseModel
{
    /*
     * 通过状态获取商户
     * */
    public function getBisByStatus($status=0){
        $order=[
          'id'=>'desc',
        ];
        $data = [
            'status'=>$status,
        ];
        return $this->where($data)
            ->order($order)
            ->paginate();
    }

}