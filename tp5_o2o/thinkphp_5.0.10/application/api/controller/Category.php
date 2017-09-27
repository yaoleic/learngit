<?php
namespace app\api\controller;
use think\Controller;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/6
 * Time: 18:50
 */
class Category extends Controller
{
    private $obj;
    public function _initialize()
    {
       $this->obj=model('Category');
    }

    public function getCategorysByParentId(){
        $id = input('post.id');
        if(empty($id)){
            $this->error('ID不合法');
        }
        //通过ID获取二级分类
        $categorys = $this->obj->getNormalCategorysByParentId($id);
        if(!$categorys){
            return show(0,'error');
        }else{
        return show(1,'success',$categorys);
        }

    }

}