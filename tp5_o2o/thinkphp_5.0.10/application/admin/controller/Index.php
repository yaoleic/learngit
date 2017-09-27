<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\controller\Base;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/6
 * Time: 18:50
 */
class Index extends Base
{
    public function index(){
        return $this->fetch();
    }
    public function welcome(){
        return '欢迎来到 o2o';
    }

}