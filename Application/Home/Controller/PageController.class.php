<?php
/**
 * Created by PhpStorm.
 * User: hezhaoyang
 * Date: 5/13/2015
 * Time: 4:26 PM
 */
namespace Home\Controller;

use Think\Controller;

class PageController extends CommonController
{
    public function index()
    {
        $id = I("param.id");
        $page = M("page")->where("id = $id")->find();
        $page['content'] = html_entity_decode($page['content']);
        $this->assign("page", $page);

        $this->pagesideleft($id);

        $this->display();
    }

    public function message()
    {
        $nid = I("param.id");
        //文章列表页左边导航
        $navleft = M("Newsclass");
        $current = $sidef = $navleft->where("id=$nid")->find();
        if ($sidef['fid'] != 0) {
            $nid = $sidef['fid'];
            $sidef = $navleft->where("id=$sidef[fid]")->find();

        }
        $sidec = $navleft->where("fid=$nid")->select();

        $this->assign("sidef", $sidef);
        $this->assign("current", $current);
        $this->assign("sidec", $sidec);//左边导航完成
        $this->display();
    }

    public function msgsubmit()
    {
        $data['name'] = I('param.name');
        $data['content'] = I("param.content");
        $data['title'] = I("param.title");
        $data['phone'] = I("param.phone");
        $data['date'] = time();
        $message = M("Message");
        $result = $message->add($data);

        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('留言成功,等待管理员审核');
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('留言失败');
        }
    }

    public function messageshow()
    {
        $nid = I("param.id");
        //文章列表页左边导航
        $navleft = M("Newsclass");
        $current = $sidef = $navleft->where("id=$nid")->find();
        if ($sidef['fid'] != 0) {
            $nid = $sidef['fid'];
            $sidef = $navleft->where("id=$sidef[fid]")->find();

        }
        $sidec = $navleft->where("fid=$nid")->select();

        $this->assign("sidef", $sidef);
        $this->assign("current", $current);
        $this->assign("sidec", $sidec);//左边导航完成

        //选择留言
        $message = M("Message");
        $count = $message->where("display=1")->count();
        $Page = new \Think\Page($count, 10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $msglist = $message->order('replydate desc')->where("display=1")->limit($Page->firstRow . ',' . $Page->listRows)->select();

        $this->assign("page1", $show);
        $this->assign("msglist", $msglist);
        //选择留言完成
        $this->display();
    }

}