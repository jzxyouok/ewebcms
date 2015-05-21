<?php
/**
 * Created by PhpStorm.
 * User: hezhaoyang
 * Date: 5/2/2015
 * Time: 9:10 PM
 */
namespace Admin\Controller;

use Think\Controller;

class RbacController extends CommonController
{

    //用户管理
    public function userList()
    {
        $model = D('User');
        $list = $model->order('admins.id desc')->select();
        //echo $model->getLastsql();
        //print_r($list);return;
        //从部门表中选择出用户所属的部门名称 加入$list中
        for ($i = 0; $i < count($list); $i++) {
            $dptid = $list[$i]['dpt'];
            $model = M('Depart');
            $dptlist = $model->where("id=$dptid")->find();
            $list[$i]['dptname'] = $dptlist['name'];
        }
        $this->assign("list", $list);
        $this->assign("editurl", U('Admin/Rbac/editUser'));
        $this->assign("delurl", U('Admin/Rbac/delUser'));
        $this->display();
    }

    public function addUser()
    {
        //对角色进行选择
        $role = M('role');
        $rlist = $role->where('status=1')->field('id,name')->select();
        $this->assign("roles", $rlist);

        //对部门进行选择
        $model = M("Depart");
        $classlist = $model->where('fid=0')->select();

        foreach ($classlist as $value) {
            $cid = $value['id'];
            $list = $model->where('fid=%d', $cid)->select();

            $cl = array('f' => $value, 'c' => $list);
            $result[] = $cl;
        }

        $this->assign("dptlist", $result);//返回页面
        $this->display();
    }


    public function submitUser()
    {
        if (IS_POST) {

            $model = M('admins');
            $data['username'] = I('post.username');
            $data['name'] = I('post.name');
            $data['mid'] = I('post.mid');
            $data['tel'] = I('post.tel');
            $data['email'] = I('post.email');
            $data['password'] = md5(I('post.password') . "EWEBCMS");
            $data['dpt'] = I('post.dptid');
            $model->create($data);
            $id = $result = $model->add();
            // echo $id;return;
            //添加用户与组关系到关系表
            $data1['role_id'] = I('post.mid');
            $data1['user_id'] = $id;
            $model = M('Role_user');
            $result = $model->add($data1);
            if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('新增成功', U('Admin/Rbac/userList'));
            } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('新增失败', $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function editUser()
    {
        //对用户资料选择
        $id = I('param.id');
        $model = M('Admins');
        $list = $model->where('id=%d', $id)->select();
        //echo $id;var_dump($list);return;
        $this->assign("list", $list[0]);
        $role = M('role');
        $rlist = $role->where('status=1')->field('id,name')->select();
        $this->assign("roles", $rlist);

        //对部门进行选择
        $model = M("Depart");
        $classlist = $model->where('fid=0')->select();

        foreach ($classlist as $value) {
            $cid = $value['id'];
            $list = $model->where('fid=%d', $cid)->select();
            $cl = array('f' => $value, 'c' => $list);
            $result[] = $cl;
        }

        $this->assign("dptlist", $result);//返回页面
        $this->display();
    }

    public function updateUser()
    {
        $model = M('admins');
        $id1 = I('post.id');
        $data['username'] = I('post.username');
        $data['name'] = I('post.name');
        $data['mid'] = I('post.mid');
        $data['tel'] = I('post.tel');
        $data['email'] = I('post.email');
        $data['password'] = md5(I('post.password') . "EWEBCMS");
        $data['dpt'] = I('post.dptid');
        $result = $model->where("id=$id1")->save($data);

        //添加用户与组关系到关系表
        $data1['role_id'] = I('post.mid');
        $data1['user_id'] = $id1;
        $model = M('Role_user');
        $model->where("user_id=$id1")->save($data1);
        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('修改成功', U('Admin/Rbac/userList'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('修改失败', $_SERVER['HTTP_REFERER']);
        }
    }

    public function delUser()
    {
        $id = I('param.id');
        $model = M('Admins');
        $model->where("id=$id")->delete();
        $result = M('Role_user')->where("user_id=$id")->delete();
        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('修改成功', $_SERVER['HTTP_REFERER']);
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('修改失败', $_SERVER['HTTP_REFERER']);
        }

    }

    //角色管理
    public function roleList()
    {
        $model = M('Role');
        $rolelist = $model->select();
        $this->assign("list", $rolelist);
        $this->assign("editurl", U('Admin/Rbac/editRole'));
        $this->assign("delurl", U('Admin/Rbac/delRole'));
        $this->assign("accessurl", U('Admin/Rbac/setAccess'));
        $this->assign("rmanageurl", U('Admin/Rbac/roleManage'));
        $this->display();
    }

    public function addRole()
    {
        $this->display();
    }

    public function submitRole()
    {
        $data = I('param.');
        $model = M('role');
        $model->create($data);
        $result = $model->add();
        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('新增成功', U('Admin/Rbac/roleList'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('新增失败', U('Admin/Rbac/roleList'));
        }
    }

    public function editRole()
    {
        $id = I('param.id');
        $role = M('Role')->where("id=$id")->find();
        $this->assign("role", $role);
        $this->display();
    }

    public function updateRole()
    {
        $data = I('param.');
        $result = M('Role')->where("id=$data[id]")->save($data);
        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('更新成功', U('Admin/Rbac/roleList'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('更新失败或者没有做任何改变', U('Admin/Rbac/roleList'));
        }
    }

    public function delRole()
    {
        $id = I('param.id');
        $model = M('Role');
        $result = $model->where("id=$id")->delete();

        $node = M('Access');
        $node->where("role_id=$id")->delete();

        $user = M('Admins');
        $user->where("mid=$id")->delete();

        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('删除成功', U('Admin/Rbac/roleList'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('删除失败', U('Admin/Rbac/roleList'));
        }
    }

    public function roleManage()
    {
        $id = I('param.id');
//        echo $id;
//        $model = M("Admin");
//        $list = $model -> where("id=$id") -> select();

        $model = D('User');
        $list = $model->where("admins.mid=$id")->order('admins.id desc')->select();
        //echo $model->getLastsql();
        //print_r($list);return;
        //从部门表中选择出用户所属的部门名称 加入$list中
        for ($i = 0; $i < count($list); $i++) {
            $dptid = $list[$i]['dpt'];
            $model = M('Depart');
            $dptlist = $model->where("id=$dptid")->find();
            $list[$i]['dptname'] = $dptlist['name'];
        }
        $this->assign("list", $list);
        $this->assign("editurl", U('Admin/Rbac/editUser'));
        $this->assign("delurl", U('Admin/Rbac/delUser'));
        $this->display("userList");
    }

    //权限管理

    public function nodeList()
    {
        $tree = new \Org\Util\Tree();
        $model = M('Node');
        $nodelist = $model->order("sort")->select();
        $nodelist = $tree->create($nodelist);
        $this->assign("list", $nodelist);
        $this->assign("editurl", U('Admin/Rbac/editNode'));
        $this->assign("delurl", U('Admin/Rbac/delNode'));
        $this->display();
    }

    public function addNode()
    {
        $model = M("Node");
        $nodelist = $model->where("level=1 or level=2")->order('sort')->select();
        $tree = new \Org\Util\Tree();
        $nodelist = $tree->create($nodelist);
        $this->assign("list", $nodelist);
        $this->display();
    }

    public function submitNode()
    {
        $data = I("param.");
//        var_dump($data);
        $model = M("Node");
        $model->create($data);
        $result = $model->add();
        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('新增成功', U('Admin/Rbac/nodeList'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('新增失败', U('Admin/Rbac/nodeList'));
        }

    }

    public function editNode()
    {
        $id = I('param.id');
        $node = M('Node')->where("id=$id")->find();
        $this->assign("node", $node);
        $nodelist = M('Node')->where('level=1 or level=2')->order('sort')->select();
        $tree = new \Org\Util\Tree();
        $nodelist = $tree->create($nodelist);
        $this->assign("list", $nodelist);
        $this->display();
    }

    public function updateNode()
    {
        $data = I('param.');
        // var_dump($data);return;
        $result = M('Node')->where("id=$data[id]")->save($data);

        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('更新成功', U('Admin/Rbac/nodeList'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('更新失败或者没有做任何改变', U('Admin/Rbac/nodeList'));
        }
    }

    public function delNode()
    {
        $id = I('param.id');
        $model = M('Node');
        $cids = $model->where("pid=$id")->select();
        foreach ($cids as $val) {
            $data[] = $val['id'];
        }
        // dump($pids);return;
        $pids = join(',', $data);
        //var_dump($pids);return;
        $result = $model->where("id=$id or pid=$id or pid in ($pids)")->delete();

        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('删除成功', U('Admin/Rbac/nodeList'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('删除失败', U('Admin/Rbac/nodeList'));
        }
    }

    public function sortNode()
    {
        $id = I('param.id');
        $sort = I('param.sort');
        $node = M('Node');
        $count = count($id);
        for ($i = 0; $i < $count; $i++) {
            $data[$i]['id'] = $id[$i];
            $data[$i]['sort'] = $sort[$i];
        }
        $re = 0;
        for ($i = 0; $i < count($data); $i++) {
            $result = $node->where('id=%d', $data[$i]['id'])->save($data[$i]);
            $re += $result;
        }
        // dump($data);return;
        if ($re) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('排序成功', $_SERVER['HTTP_REFERER']);
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('排序失败或者没有做任何改变', $_SERVER['HTTP_REFERER']);
        }

    }

    public function setAccess()
    {
        $rid = I('param.id', '', int);
        $rname = M("Role")->getFieldById($rid, 'name');
        $this->assign("rid", $rid);
        $this->assign("rname", $rname);

        $tree = new \Org\Util\Tree();
        $nodelist = M('node')->order('sort')->select();
        $nodelist = $tree->create($nodelist);


        $data = array();
        $access = M('Access');
        foreach ($nodelist as $value) {
            $count = $access->where("role_id=$rid and node_id=$value[id]")->find();
            if ($count) {
                $value['access'] = 1;
            } else {
                $value['access'] = 0;
            }
            $data[] = $value;
        }
        // dump($data);
        $this->assign("nodelist", $data);
        $this->display();
    }

    public function submitAccess()
    {
        $rid = I('param.rid', '', int);
        $access = M('Access');
        $access->where("role_id=$rid")->delete();
        if (isset($_POST['access'])) {
//            dump($_POST['access']);
            $data = array();
            foreach ($_POST['access'] as $value) {
                $tmp = explode('_', $value);

                $data[] = array(
                    'role_id' => $rid,
                    'node_id' => $tmp[0],
                    'level' => $tmp[1],
                );
                //dump($data);
            }

            $result = $access->addAll($data);
            if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('修改成功', U('Admin/Rbac/roleList'));
            } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('修改失败或者没有做任何改变', U('Admin/Rbac/roleList'));
            }

        } else {
            $this->error("修改失败或者未勾选任何选项", $_SERVER['HTTP_REFERER']);
        }

    }

}