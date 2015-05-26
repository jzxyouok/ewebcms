<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends CommonController
{
    public function index()
    {
        //新闻部分
        //主页新闻类型编号:若想更改显示的栏目.只修改这里即可
        $nids = array(121, 122, 123, 163);//学工新闻/通知公告/文明公寓/学子风采

        // dump($nids);return;
        $news = M("News");
        $newsclass = M("Newsclass");
        foreach ($nids as $nid) {
            $highlight[] = $news->field("id,title,updatetime")->where("nid=$nid and highlight=1")->find();
            $newslist[] = $news->field("id,title,updatetime")->where("nid=$nid and highlight=0")->order("updatetime desc")->limit(4)->select();

            $classname[] = $newsclass -> field('fid,name') -> where("id=$nid") -> find();
        }
        // dump($newslist);return;
        $this-> assign("classname", $classname);
        $this->assign("highlight", $highlight);
        $this->assign("newslist", $newslist);//新闻返回页面
        $this->assign("nids", $nids);
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
        if ($verify->check($code)) {
            echo "true";
        } else {
            echo "false";
        }


    }
}