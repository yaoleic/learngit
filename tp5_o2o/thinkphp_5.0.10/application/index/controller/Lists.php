<?php
namespace app\index\controller;
use think\Controller;
class Lists extends Base{
    public function index(){
        $firstCatIds=[];
        $categorys=model('Category')->getNormalCategorysByParentId();
        foreach ($categorys as $category){
            $firstCatIds[]=$category->id;
        }
        $data=[];
        $id=input('id',0,'intval');
        //id = 0 一级分类 二级分类
        if(in_array($id,$firstCatIds)){
            $categoryParentId=$id;
            $data['category_id']=$id;
        }elseif ($id) {//二级分类
        //获取二级分类数据
            $category = model('Category')->get($id);
            if(empty($category)||$category->status!=1){
                $this->error('数据不合法');
            }
            $categoryParentId=$category->parent_id;
            $data['se_category_id']=$id;
        }else{
            $categoryParentId=0;
        }
        $sedcategorys=[];
        //获取父类下的所有子类
        if($categoryParentId){
            $sedcategorys=model('Category')->getNormalCategorysByParentId($categoryParentId);
        }
        $orders=[];
        //排序数据获取的逻辑
        $order_sales=input('order_sales','');
        $order_price=input('order_price','');
        $order_time=input('order_time','');
        if(!empty($order_sales))
        {
            $orderflag=$order_sales;
            $orders['order_sales']=$order_sales;
        }elseif (!empty($order_price)) {
            $orderflag=$order_price;
            $orders['order_price']=$order_price;
        }elseif (!empty($order_time)){
            $orderflag=$order_time;
            $orders['order_time']=$order_time;
        }  else{
            $orderflag='';
        }
        $data['city_id'] = $this->city->id;
        //根据上面条件查询数据
        $deals=model('Deal')->getDealByConditions($data,$orders);

            return $this->fetch('',[
            'categorys'=>$categorys,
            'sedcategorys'=>$sedcategorys,
            'id'=>$id,
            'categoryParentId'=>$categoryParentId,
            'orderflag'=>$orderflag,
            'deals'=>$deals,
        ]);
    }
}