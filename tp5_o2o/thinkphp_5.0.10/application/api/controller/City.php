<?php
namespace app\api\controller;
use think\Controller;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/6
 * Time: 18:50
 */
class City extends Controller
{
    private $obj;
    public function _initialize()
    {
       $this->obj=model('City');
    }

    public function getCitysByParentId(){
        $id = input('post.id');
        if(empty($id)){
            $this->error('ID不合法');
        }
        //通过ID获取二级城市
        $citys = $this->obj->getNormalCitysByParentId($id);
        if(!$citys){
            return show(0,'error');
        }else{
        return show(1,'success',$citys);
        }

    }

}