<?php
namespace app\api\controller;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/6
 * Time: 18:53
 */
use think\Controller;
use think\Request;
use think\File;
class Image extends Controller
{
    public function upload(){
        $file=Request::instance()->file('file');
        //给定一个目录
        $info=$file->move('upload');

        if($info && $info->getPathname()){
            return show(1,'success','/'.$info->getPathname());
        }
        return show(0,'upload error');
    }

}