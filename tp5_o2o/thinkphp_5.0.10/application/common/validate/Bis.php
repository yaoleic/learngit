<?php
namespace  app\common\validate;
use think\Validate;
class Bis extends Validate{
    protected $rule=[
        'name'=>'require|max:25',
        'eamil'=>'eamil',
        'logo'=>'require',
        'city_id'=>'require',
        'bank_info'=>'require',
        'bank_name'=>'require',
        'bank_user'=>'require',
        'faren'=>'require',
        'faren_tel'=>'require',
    ];
    //场景设置
    protected $scene = [
        'add'=>['name','eamil','logo','city_id','bank_info','bank_name','bank_user','faren','faren_tel'],

    ];
}