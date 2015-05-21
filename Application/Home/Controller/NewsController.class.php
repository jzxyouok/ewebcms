<?php
/**
 * Created by PhpStorm.
 * User: hezhaoyang
 * Date: 5/13/2015
 * Time: 3:16 PM
 */
namespace Home\Controller;

use Think\Controller;

class NewsController extends CommonController
{

    public function index()
    {
        $this->display();
    }

    public function newslist()
    {

        $id = I("param.id");
        $this->selectnews($id);//根据提交id获取新闻
        $this->display();
    }

    public function show()
    {
        $id = I("param.id");
        $this->newsshow($id);
        $this->display();
    }


}