<?php
namespace  app\common\validate;
use think\Validate;
class BisLocation extends Validate{
    protected $rule=[
        'name'=>'require|max:25',
        'logo'=>'require',
        'city_id'=>'require',
        'bank_info'=>'require',
        'address'=>'require',
        'tel'=>'require|number',
        'category_id'=>'require',
        'content'=>'require',
        'bis_id'=>'require|number',
        'open_time'=>'require',
    ];
    //场景设置
    protected $scene = [
        'add'=>['name','city_id','bank_info','tel','content'],

    ];
}