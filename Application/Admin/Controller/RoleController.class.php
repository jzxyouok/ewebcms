<?php
namespace Admin\Controller;

use Think\Controller;

class RoleController extends CommonController
{
    public function index()
    {
    //    $this->shellcheck(7);
        $model = M('roles');
        $list = $model->select();
        $this->assign("list", $list);
        $permission1 = array('8' => "无", '6' => "查看", '4' => '查看、修改', '2' => '查看、修改、新增', '0' => '查看、修改、新增、删除');
        $permission2 = array('8' => "无", '6' => "查看", '2' => '查看、回复', '0' => '查看、回复、删除');
        $this->assign("p1", $permission1);
        $this->assign("p2", $permission2);
        $this->assign("editurl", U('Admin/Role/edit'));
        $this->assign("delurl", U('Admin/Role/del'));
        $this->display();
    }

    public function add()
    {
     //   $this->shellcheck(3);
        $this->display();
    }

    public function addsubmit()
    {
     //   $this->shellcheck(3);
        $model = M('roles');
        $model->create();
        $result = $model->add();
        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('新增成功', U('Admin/Role/index'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('新增失败', U('Admin/Role/index'), 10);
        }

    }

    public function edit()
    {
    //    $this->shellcheck(5);
        $id = I('param.id');
        $model = M('roles');
        $list = $model->where('id=%d', $id)->select();
        $this->assign("list", $list[0]);

        if ($list[0][doclevel] == "0") $this->assign("doco", "selected='selected'");
        if ($list[0][doclevel] == "2") $this->assign("doc2", "selected='selected'");
        if ($list[0][doclevel] == "4") $this->assign("doc4", "selected='selected'");
        if ($list[0][doclevel] == "6") $this->assign("doc6", "selected='selected'");

        if ($list[0][classlevel] == "0") $this->assign("class0", "selected='selected'");
        if ($list[0][classlevel] == "2") $this->assign("class2", "selected='selected'");
        if ($list[0][classlevel] == "4") $this->assign("class4", "selected='selected'");
        if ($list[0][classlevel] == "6") $this->assign("class6", "selected='selected'");

        if ($list[0][messlevel] == "0") $this->assign("mess0", "selected='selected'");
        if ($list[0][messlevel] == "2") $this->assign("mess2", "selected='selected'");
        if ($list[0][messlevel] == "6") $this->assign("mess6", "selected='selected'");

        if ($list[0][memblevel] == "0") $this->assign("memb0", "selected='selected'");
        if ($list[0][memblevel] == "2") $this->assign("memb2", "selected='selected'");
        if ($list[0][memblevel] == "4") $this->assign("memb4", "selected='selected'");
        if ($list[0][memblevel] == "6") $this->assign("memb6", "selected='selected'");

        $this->display();

    }

    public function del()
    {
      //  $this->shellcheck(1);
        $id = I('param.id');
        $model = M('roles');
        $result = $model->delete($id);
        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('删除成功', U('Admin/Role/index'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('删除失败', U('Admin/Role/index'));
        }

    }

    public function update()
    {
    //    $this->shellcheck(5);


        if (IS_POST) {

            $id = I('post.id');
            $data['name'] = I('post.name');
            $data['doclevel'] = I('post.doclevel');
            $data['classlevel'] = I('post.classlevel');
            $data['messlevel'] = I('post.messlevel');
            $data['memblevel'] = I('post.memblevel');

            $model = M('roles');
            $result = $model->where('id=%d', $id)->save($data);
            if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('修改成功', U('Admin/Role/index'));
            } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('修改失败', U('Admin/Role/index'), 10);
            }


        }
    }




    public function shellcheck($level = 9)
    {
        $result = Get_user_shell_check(I('session.uid'), I('session.shell'), "MEMB", $level);
        if ($result == "UNL") {
            $this->error("您还没有登录，请登录！", U('Admin/Index/index'));
            exit();
        }
        if ($result == "UNP") {
            $this->error("您没有权限操作！");
            exit();
        }
        $timeout = Get_user_ontime();
        if ($timeout == "TIMEOUT") $this->error("时间超时，请重新登录！", U('Admin/Index/index'));
    }

}