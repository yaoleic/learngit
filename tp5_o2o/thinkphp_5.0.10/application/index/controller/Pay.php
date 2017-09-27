<?php
namespace app\index\controller;
use think\Controller;
use think\Exception;

class Pay extends Base{
  public function index(){
      return $this->fetch();
  }
}