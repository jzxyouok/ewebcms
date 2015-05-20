<?php
namespace Admin\Controller;

use Think\Controller;

class NewsClassController extends CommonController
{
    public function index()
    {
        if (empty($_REQUEST['navid'])) {
            $model = M('Nav');
            $ls = $model->select();
            $navid = $ls[0]['id'];
        } else {
            $navid = $_REQUEST['navid'];
        }

        $model = M("newsclass");
        $classlist = $model->order('listorder asc,id')->where('fid=0 and navid=%d', $navid)->select();
        foreach ($classlist as $value) {
            $cid = $value['id'];
            $list = $model->order('listorder asc,id')->where('fid=%d', $cid)->select();
            //如果有子类的话，将子类新闻的数量添加进行，重新组合数组。
            if ($list) {
                foreach ($list as $value2) {
                    $newsModel = M("news");
                    $number = $newsModel->where('nid=%d', $value2['id'])->count();
                    array_push($value2, $number);
                    $resultlist[] = $value2;
                }
                $cl = array('f' => $value, 'c' => $resultlist);
                $result[] = $cl;
            } else {
                $cl = array('f' => $value, 'c' => $list);
                $result[] = $cl;
            }
            unset($resultlist);
        }

        $model = M('Nav');
        $list = $model->select();
//        print_r($list);
//        return;
        $this->assign("navcats", $list);
        $this->assign("navid", $navid);
        $this->assign("editurl", U('Admin/NewsClass/edit'));
        $this->assign("delurl", U('Admin/NewsClass/del'));
        $this->assign("addurl", U('Admin/NewsClass/add'));
        $this->assign("showurl", U('Admin/NewsClass/show'));
        $this->assign("list", $result);
        $this->display();
    }

    public function add()
    {
        //选择nav表中第一个导航
        if (empty($_REQUEST['navid'])) {
            $model = M('Nav');
            $ls = $model->select();
            $navid = $ls[0]['id'];
        } else {
            $navid = $_REQUEST['navid'];
        }

        $model = M('Nav');
        $navlist = $model->select();
        $this->assign("navcats", $navlist);
        $this->assign('navid', $navid);//选择导航结束

        //把所有以及菜单选择出来
        $model = M("newsclass");
        $classlist = $model->field('id,name')->where('fid=0 and navid=%d', $navid)-> order("listorder asc") ->select();
        //选择菜单结束

        //提交过来的菜单id
        $id = I('param.id');
        $this -> assign("classid",$id);
        //返回前台页面

        $this->assign("classlist", $classlist);
        $this->display();
    }

    public function addurl()
    {
        if (empty($_REQUEST['navid'])) {
            $model = M('Nav');
            $ls = $model->select();
            $navid = $ls[0]['id'];
        } else {
            $navid = $_REQUEST['navid'];
        }

        $model = M('Nav');
        $navlist = $model->select();
        $this->assign("navcats", $navlist);
        $this->assign('navid', $navid);

        $model = M("newsclass");

        $classlist = $model->field('id,name')->where('fid=0 and navid=%d', $navid)-> order("listorder asc")->select();

        $this->assign("classlist", $classlist);
        $this->display();
    }

    public function addpage()
    {
        if (empty($_REQUEST['navid'])) {
            $model = M('Nav');
            $ls = $model->select();
            $navid = $ls[0]['id'];
        } else {
            $navid = $_REQUEST['navid'];
        }

        $model = M('Nav');
        $navlist = $model->select();
        $this->assign("navcats", $navlist);
        $this->assign('navid', $navid);

        $model = M("newsclass");

        $classlist = $model->field('id,name')->where('fid=0 and navid=%d', $navid)-> order("listorder asc")->select();

        $this->assign("classlist", $classlist);
        $this->display();
    }

    public function addsubmit()
    {
        $navid = I('param.navid');
        if (IS_POST) {
            $type = $_GET['type'];

            if ($type == 1) {
                $model = M("newsclass");
                $data = I('post.');
                $data['navid'] = $navid;
                $id = $model->add($data);
                $data['href'] = "Home/News/newslist?id={$id}";
                if(strstr($data['name'],"首页")){
                    $data['href'] = "Home";
                }
                $result = $model->where('id=%d', $id)->save($data);
            } elseif ($type == 2) {
                $model = M("newsclass");
                $data = I('post.');
                $data['type'] = "外部链接";
                $data['typeid'] = 2;
                $data['navid'] = $navid;
                $result = $model->add($data);
            } elseif ($type == 3) {
                $model = M('page');
                $data['content'] = I('post.myconten');
                $data['title'] = I('post.title');
                $data['keyword'] = I('post.keyword');
                $data['excerpt'] = I('post.excerpt');
                $data['updatetime'] = time(I('post.updatetime'));
                $idd = $model->add($data);

                $data['fid'] = I('post.fid');
                $model = M("newsclass");
                $data1['page_id'] = $idd;
                $data1['navid'] = $navid;
                $data1['href'] = "Home/Page/index?id={$idd}";
                $data1['name'] = $data['title'];
                $data1['remark'] = $data['remark'];
                $data1['typeid'] = 3;
                $data1['fid'] = $data['fid'];
                $data1['type'] = "单网页";
                $result = $model->add($data1);
            }

            if ($result) {
                //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('新增成功', U('Admin/NewsClass/index'));
            } else {
                //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('新增失败', U('Admin/NewsClass/add'));
            }
        }

    }

    public function edit()
    {
        $id = I('param.id');
        $typeid = $_GET['typeid'];

        if (empty($_REQUEST['navid'])) {
            $model = M('Nav');
            $ls = $model->select();
            $navid = $ls[0]['id'];
        } else {
            $navid = $_REQUEST['navid'];
        }

        $model = M('Nav');
        $navlist = $model->select();
        $this->assign("navcats", $navlist);
        $this->assign('navid', $navid);

        $model = M('newsclass');
        $list = $model->where('id=%d', $id)->select();
        $this->assign("newsclass", $list[0]);
        $list = $model->where("fid=0 and id!=$id and navid=$navid")-> order("listorder asc") ->select();
        $this->assign('classlist', $list);


        if ($typeid == 1) {

            $this->display();
        } elseif ($typeid == 2) {
            $this->display("editurl");
        } elseif ($typeid == 3) {
            $pagehref = $model->where('id=%d', $id)->getField('href');
            $start = strpos($pagehref, 'id=');
            $id = substr($pagehref, $start + 3);
            $id = preg_replace("/&.*/s", "", $id);
            $model = M('Page');
            $listcon = $model->where('id=%d', $id)->find();
            $this->assign("listcon", $listcon);
            $this->display("editpage");
        }


    }

    public function update()
    {
        $id = I('param.id');
        $type = $_REQUEST['type'];
        if ($type == 1) {
            $data['name'] = I('name');
            $data['fid'] = I('fid');
            $data['remark'] = I('remark');
            $data['navid'] = I('navid');
            $model = M('newsclass');
            $result = $model->where('id=%d', $id)->save($data);

            //父栏目的子类也应该加入该栏目下 因为现在只支持两级菜单
            if (I('fid') != 0) {
                $data1['fid'] = I('fid');
                $model->where("fid=$id")->save($data1);
            }

        } elseif ($type == 2) {
            $data['name'] = I('name');
            $data['fid'] = I('fid');
            $data['remark'] = I('remark');
            $data['href'] = I('href');
            $data['navid'] = I('navid');
            $model = M('newsclass');
            $result = $model->where('id=%d', $id)->save($data);

            //父栏目的子类也应该加入该栏目下 因为现在只支持两级菜单
            if (I('fid') != 0) {
                $data1['fid'] = I('fid');
                $model->where("fid=$id")->save($data1);
            }
        } elseif ($type == 3) {
            $model = M('Newsclass');
            $data1['name'] = I('post.title');
            $data1['fid'] = I('post.fid');
            $data1['navid'] = I('post.navid');
            $model->where('page_id=%d', $id)->save($data1);

            //父栏目的子类也应该加入该栏目下 因为现在只支持两级菜单
            if (I('post.fid') != 0) {
                $data1['fid'] = I('fid');
                $model->where("fid=$id")->save($data1);
            }

            $model = M('page');
            $data['content'] = I('post.myconten');
            $data['title'] = I('post.title');
            $data['keyword'] = I('post.keyword');
            $data['excerpt'] = I('post.excerpt');
            $data['updatetime'] = time(I('post.updatetime'));
            $result = $model->where('id=%d', $id)->save($data);
        }

        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('修改成功', U('admin/NewsClass/index'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('修改失败后者没有做任何改变', U('admin/NewsClass/index'));
        }

    }

    public function del()
    {
        $id = I('param.id');
        $model = M('newsclass');
        //为之后删除page表中关联查找id
        $page_id = $model->where('id=%d', $id)->getField('page_id');
        $result = $model->where("id=%d", $id)->delete();
        $model->where('fid=%d', $id)->delete();


        //删除news表中关联的
        $model2 = M('news');
        $model2->where("nid=%d", $id)->delete();
        //删除page表中关联的
        $model3 = M('page');
        $model3->where("id=%d", $page_id)->delete();
        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('删除成功', U('Admin/NewsClass/index'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('删除失败', U('Admin/NewsClass/index'));
        }
    }


    public function delallOrSort()
    {
        $delall = I('param.delall');
        $sort = I('param.sort');
        $ids = join(",", I('param.ids'));
        $listorder = I('param.listorder');

        //var_dump($ids);
        //  var_dump($listorder);
        foreach ($listorder as $key => $val) {
            $list[]['id'] = $key;
            $list[]['listorder'] = $val;
        }
        //排序

        $model = M('newsclass');
        if ($sort) {
            $re = 0;
            for ($i = 0; $i < count($list); $i = $i + 2) {
                $result = $model->where('id=%d', $list[$i]['id'])->save($list[$i + 1]);
                $re += $result;
            }
            if ($re) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('排序成功', $_SERVER['HTTP_REFERER']);
            } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('排序失败或者没有做任何改变', $_SERVER['HTTP_REFERER']);
            }
        } //删除选择的项
        elseif ($delall) {
            $arr_ids = explode(",", $ids);
            for ($i = 0; $i < count($arr_ids); $i++) {
                $page_id[$i] = $model->where("id=%d", $arr_ids[$i])->getField('page_id');
            }
            $page_ids = join(",", $page_id);
            //删除newsclass中关联的记录
            $result = $model->where("id in ($ids)")->delete();
            //删除news表中关联的记录
            $model2 = M('news');
            $model2->where("nid in ($ids)")->delete();
            //删除page表中关联的数据
            $model2 = M('page');
            $model2->where("id in ($page_ids)")->delete();

            if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('删除成功', $_SERVER['HTTP_REFERER']);
            } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('删除失败', $_SERVER['HTTP_REFERER'], '2');
            }
        }
    }

    //控制栏目是否可见
    function show()
    {
    //    $this->shellcheck(1);
        $choose = I('param.choose');
        $id = I('param.id');
        if ($choose) {
            $model = M('newsclass');
            $data['display'] = 1;
            if ($fid = $model->where("id=%d", $id)->getField('fid')) {
                if (!$model->where('id=%d', $fid)->getField('display')) {
                    $this->error("其父栏目不可见不可设置其可见", $_SERVER['HTTP_REFERER']);
                }
            }

            $result = $model->where("id=%d", $id)->save($data);
        } else {
            $model = M('newsclass');
            $data['display'] = 0;
            $result = $model->where("id=%d", $id)->save($data);
            $model->where("fid=%d", $id)->save($data);
        }
        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('操作成功', $_SERVER['HTTP_REFERER']);
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('操作失败或者没有做任何改变', $_SERVER['HTTP_REFERER']);
        }
    }

    /*
     * 导航编辑部分
     */
    public function navindex()
    {
        //    $this->shellcheck(7);
        $model = M('Nav');
        $list = $model->select();
        $this->assign("navlist", $list);
        $this->assign("addurl", U('Admin/NewsClass/navadd'));
        $this->assign("editurl", U('Admin/NewsClass/navedit'));
        $this->assign("delurl", U('Admin/NewsClass/navdel'));
        $this->display();

    }

    public function navadd()
    {
        $this->display();
    }

    public function navaddsubmit()
    {
        $data = I('param.');
        //print_r($data);
        $model = M('Nav');
        $result = $model->add($data);
        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('新增成功', U('Admin/NewsClass/navindex'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('新增失败', U('Admin/NewsClass/navadd'));
        }
    }

    public function navedit()
    {
        //    $this->shellcheck(5);
        $id = I('param.id');
        $model = M("Nav");
        $data = $model->where("id=%d", $id)->find();
        $this->assign("nav", $data);
        $this->display();
    }

    public function navupdate()
    {
        $id = I('param.id');

        $model = M('Nav');
        $data = I('param.');
        $result = $model->where('id=%d', $id)->save($data);

        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('修改成功', U('Admin/NewsClass/navindex'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('修改失败', U('Admin/NewsClass/navedit', array('id' => $id)));
        }

    }

    public function navdel()
    {
        $id = I('param.id');
        $model = M("Nav");
        $result = $model->where("id=$id")->delete();

        $pages = M("Newsclass") -> field("page_id") -> where("navid=$id and typeid=3") -> select();
        foreach($pages as $val){
            $page[] = $val['page_id'];
        }
        $pagess = join(",", $page);

        M("Page") -> where("id in ($pagess)") -> delete();//删除单页面
        M("Newsclass") -> where("navid=$id") -> delete();//删除导航下的菜单

        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('删除成功', U('Admin/NewsClass/navindex'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('删除失败', U('Admin/NewsClass/navindex'));
        }
    }

}