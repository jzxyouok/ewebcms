<?php
/**
 * Created by PhpStorm.
 * User: hezhaoyang
 * Date: 5/13/2015
 * Time: 4:26 PM
 */
namespace Home\Controller;

use Think\Controller;

class WechatController extends CommonController
{
    public function index()
    {

    }

    public function newslist()
    {
        $id = I('param.id');
        $this->selectnews($id);
        $this->display();
    }

    public function show()
    {
        $id = I("param.id");
        $this->newsshow($id);
        $this->display();
    }
}