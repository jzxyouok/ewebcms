<?php
namespace Admin\Controller;

use Think\Controller;

class UserController extends Controller
{
    public function editinfo()
    {
        $id = I('param.id');
        $model = D('User');
        $list = $model->where('admins.id=%d', $id)->select();
        $this->assign("list", $list[0]);
        $role = M('roles');
        $rlist = $role->field('id,name')->select();
        $this->assign("roles", $rlist);
        $this->display();
    }

    public function editpwd()
    {
        $id = I('param.id');
        $model = D('User');
        $list = $model->where('admins.id=%d', $id)->select();
        $this->assign("list", $list[0]);
        $role = M('roles');
        $rlist = $role->field('id,name')->select();
        $this->assign("roles", $rlist);
        $this->display();
    }


    public function updateinfo()
    {
        if (IS_POST) {
            $model = M('admins');
            $id = I('post.id');
            $data['username'] = I('post.username');
            $data['name'] = I('post.name');
            $data['tel'] = I('post.tel');
            $data['email'] = I('post.email');
            if (I('post.password') != "") $data['password'] = md5(I('post.password') . "EWEBCMS");
            $result = $model->where('id=%d', $id)->save($data);
            if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('修改成功');
            } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('修改失败或者没有做任何改变');
            }
        }
    }

}