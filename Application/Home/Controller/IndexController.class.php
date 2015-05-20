<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){

        //新闻部分
        $nids = array(121, 122, 123,169);
       // dump($nids);return;
        $model = M("News");
        foreach($nids as $nid){
            $highlight[] = $model->field("id,title,updatetime")->where("nid=$nid and highlight=1")->find();
            $newslist[] = $model->field("id,title,updatetime")->where("nid=$nid and highlight=0")->order("updatetime desc")->limit(4)->select();
        }
       // dump($newslist);return;
        $this -> assign("highlight",$highlight);
        $this -> assign("newslist",$newslist);//新闻返回页面

        $this->display();
    }


    /**
     *
     * 验证码生成
     */
    public function verify_c()
    {
        $Verify = new \Think\Verify();
        $Verify->fontSize = 24;
        $Verify->length = 4;
        $Verify->useNoise = true;
        $Verify->codeSet = '0123456789';
        $Verify->imageW = 280;
        $Verify->imageH = 40;
        $Verify->entry();
    }

    public function verify_check()
    {

        $code = I('param.verify');
        $verify = new \Think\Verify();
        if ($verify->check($code)){
            echo "true";
        } else{
            echo "false";
        }


    }
}