<?php
namespace app\admin\controller;
use think\Controller;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/6
 * Time: 18:50
 */
class Bis extends Base
{
    private $obj;
    public function _initialize()
    {
       $this->obj=model('Bis');
    }
    /*
     * 商户列表
     *
     * */
    public function index(){
        $bis =$this->obj->getBisByStatus(1);
        return $this->fetch('',[
            'bis'=>$bis,
        ]);
    }
    /*
     * 商户入驻列表
     * */
    public function apply(){
        $bis =$this->obj->getBisByStatus();
        return $this->fetch('',[
            'bis'=>$bis,
        ]);
    }
    public function detail(){
        $id=input('get.id');
        if(empty($id)){
            return $this->error('ID错误');
        }
        //获取一级城市的数据
        $citys = model('City')->getNormalCitysByParentId();
        $categorys = model('Category')->getNormalCategorysByParentId();
        //获取商户数据
        $bisData =model('Bis')->get($id);
        $locationData=model('BisLocation')->get(['bis_id'=>$id,'is_main'=>1]);
        $accountData=model('BisAccount')->get(['bis_id'=>$id,'is_main'=>1]);
        return $this->fetch('',[
            'citys'=>$citys,
            'categorys'=>$categorys,
            'bisData'=>$bisData,
            'locationData'=>$locationData,
            'accountData'=>$accountData,
        ]);
    }
    public function status(){
        $data = input('get.');
      /*  $validate = validate('Bis');
        if(!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }*/
        $res = $this->obj->save(['status'=>$data['status']],['id'=>$data['id']]);
        $location= model('BisLocation')->save(['status'=>$data['status']],['bis_id'=>$data['id'],'is_main'=>1]);
        $account= model('BisAccount')->save(['status'=>$data['status']],['bis_id'=>$data['id'],'is_main'=>1]);
        $bisData =model('Bis')->get($data['id']);
        if($res && $location && $account){
           //发送邮件
           /*
            * status -1 删除 1 成功 2审核不通过
            * */
           $title="o2o入驻申请结果";

           if($data['status']==-1||$data['status']==2){
               $content="很抱歉，您的申请没有通过";
           }else{
               $content="恭喜您，您的申请通过了";
           }
            \phpmailer\Email::send($bisData['email'],$title,$content);
            $this->success('状态更新成功');
        }else{
            $this->error('状态更新失败');
        }

    }
    /*
     * 删除的商户列表
     * */
    public function dellist(){
        $bis =$this->obj->getBisByStatus(-1);
        return $this->fetch('',[
            'bis'=>$bis,
        ]);
    }
}