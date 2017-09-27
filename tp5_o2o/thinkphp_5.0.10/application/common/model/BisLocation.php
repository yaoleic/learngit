<?php
 namespace app\common\model;
 use think\Model;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/6
 * Time: 17:51
 */
class BisLocation extends BaseModel
{   public function getBisLocationByStatus($status=0){
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
    public function getNormalLocationByBisId($bisId){
        $data = [
            'bis_id' => $bisId,
            'status' => 1,
        ];

        $result = $this->where($data)
            ->order('id', 'desc')
            ->select();
        return $result;
    }
    public function getNormalLocationsInID($ids){
        $data=[
            'id'=>['in',$ids],
            'status'=>1,
        ];
        return $this->where($data)->select();
    }

}