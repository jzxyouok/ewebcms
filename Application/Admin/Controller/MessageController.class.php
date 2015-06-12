<?php
namespace Admin\Controller;

use Think\Controller;

class MessageController extends CommonController
{
    public function index()
    {
        $type = I('param.type');
        $model = M('message');
        if ($type == 0) {
            $count = $model->where('status=0')->count();// 查询满足要求的总记录数
        } elseif ($type == 1) {
            $count = $model->where()->count();// 查询满足要求的总记录数
        }

        $Page = new \Think\Page($count, 25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        if ($type == 0) {
            $newslist = $model->order('id desc')->field('id,name,title,date,phone,status,display,content,reply')->where('status=0')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        } elseif ($type == 1) {
            $newslist = $model->order('id desc')->field('id,name,title,date,phone,status,display,content,reply')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        }


        $this->assign("page", $show);
        $this->assign("list", $newslist);
        $this->assign("replyurl", U('Admin/Message/reply'));
        $this->assign("delurl", U('Admin/Message/del'));
        $this->assign("checkurl", U('Admin/Message/check'));
        $this->display();

    }

    public function reply()
    {
        $id = I('param.id');
        $model = M('message');
        $list = $model->where('id=%d', $id)->select();
        $this->assign("list", $list[0]);
        $this->display();
    }

    public function replysubmit()
    {
        if (IS_POST) {
            $data['id'] = I('post.id');
            if (I('post.display') == "on") {
                $data['display'] = 1;
            } else {
                $data['display'] = 0;
            }
            if (I('post.reply') != "") {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            $data['reply'] = I('post.reply');
            $data['replydate'] = time();
        }
        $model = M('message');
        $result = $model->save($data);
        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('回复成功', U('Admin/Message/index', array('type' => 1)));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('回复失败');
        }

    }

    public function del()
    {
        $id = I('param.id');
        $model = M('message');
        $result = $model->delete($id);
        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('删除成功', U('Admin/Message/index',array('type' => 1)));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('删除失败');
        }


    }

    public function check()
    {
        $id = I('param.id');
        $data['id'] = $id;
        $data['display'] = 1;
        $model = M('message');
        $result = $model->save($data);

        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('审核成功', U('Admin/Message/index', array('type' => 1)));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('审核失败或者没有做任何改变', U('Admin/Message/index', array('type' => 1)), 2);
        }
    }

    public function checkallOrdelall()
    {//审查全部留言或者删除所有
        $delall = I('param.delall');
        if ($delall) {
            //删除全部
            $model = M('Message');
            $ids = join(",", I('param.ids'));
            $result = $model->where("id in ($ids)")->delete();
        }
        $checkall = I('param.checkall');
        $checknone = I('param.checknone');
        if ($checkall) {
            //审核全部
            $data["display"] = 1;
            $model = M('Message');
            $ids = join(",", I('param.ids'));
            $result = $model->where("id in ($ids)")->save($data);
        } elseif ($checknone) {
            //取消审核全部
            $data["display"] = 0;
            $model = M('Message');
            $ids = join(",", I('param.ids'));
            $result = $model->where("id in ($ids)")->save($data);

        }

        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('操作成功', U('Admin/Message/index', array('type' => 1)));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('操作失败或者没有做任何改变', U('Admin/Message/index', array('type' => 1)), 2);
        }
    }
}