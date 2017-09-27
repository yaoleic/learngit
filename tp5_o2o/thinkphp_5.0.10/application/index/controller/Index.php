<?php
namespace app\index\controller;

use think\Controller;

class Index extends Base
{
    public function index()
    {
        //获取首页大图相关数据
        //获取首页广告位相关的数据
        //商品分类数据

        $datas= model('Deal')->getNormalDealByCategoryCityId(1,$this->city->id);
        //获取四个子分类
        $data=model('Featured')->getFeaturedsByType(0);
        $dataRight=model('Featured')->getFeaturedsByType(1);

        $meishicates=model('Category')->getNormalRecommendCategoryByParentId(1,4);
         return $this->fetch('',[
             'datas'=>$datas,
             'meishicates'=>$meishicates,
             'data'=>$data,
             'dataRight'=>$dataRight,
         ]);

    }

}
