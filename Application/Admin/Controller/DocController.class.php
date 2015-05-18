<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Page;

class DocController extends CommonController
{
    public function index()
    {
        $nid = I('param.id');
        $newsclass = M('newsclass');
        //对新闻进行选择
        $list = $newsclass->field('name')->where('id=%d', $nid)->select();
        $this->assign("type", $list[0]);
        $model = M("news");
        $count = $model->where('nid=%d', $nid)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count, 10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $newslist = $model->order('listorder asc,id desc')->field('id,author,title,date,clickrate,listorder')->where('nid=%d', $nid)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        //var_dump($newslist);
        $this -> assign("nname",$list[0]['name']);
        $this -> assign("nid",$nid);
        $this->assign("page", $show);
        $this->assign("newslist", $newslist);
        $this->assign("editurl", U('Admin/Doc/edit'));
        $this->assign("delurl", U('Admin/Doc/del'));
        $this->assign("addurl", U('Admin/Doc/add'));

        $this->display();
    }

    //进入添加页面
    public function add()
    {
        $nid = I('param.nid');
        $this -> assign("nid",$nid);
//        echo $nid;return;
        //对栏目进行选择
        $model = M("Nav");
        $navlist = $model->select();
//        print_r ($navlist);return;
        foreach ($navlist as $nvalue) {
            $model = M("newsclass");
            $navid = $nvalue['id'];
            $classlist = $model->where('fid=0 and typeid!=2 and typeid!=3 and navid=%d', $navid)->select();

            foreach ($classlist as $value) {
                $cid = $value['id'];
                $list = $model->where('typeid!=2 and typeid!=3 and fid=%d and navid=%d', $cid, $navid)->select();
                $cl = array('f' => $value, 'c' => $list);
                $result[] = $cl;
            }
            $c2 = array('nav' => $nvalue, 'navlist' => $result);
            $result1[] = $c2;
            unset($result);
        }

        $this->assign("newslist", $result1);//返回页面

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

    //新闻提交
    public function addsubmit()
    {
       // $this->shellcheck(3);
        if (IS_POST) {
            $news = M("news");
            $data['content'] = I('post.myconten');
            $data['title'] = I('post.title');
            $data['author'] = I('post.author');
            $data['keyword'] = I('post.keyword');
            $data['excerpt'] = I('post.excerpt');
            $data['copyfrom'] = I('post.copyfrom');
            $data['updatetime'] = time(I('post.updatetime'));
            $data['photo'] = I('post.photo');
            $data['nid'] = I('post.nid');

            $data['uid'] = $_SESSION['authId'];
            $data['dpt'] = I('post.dptid');
            //求出添加部门的父亲部门  写入表news
            $dptid = $data['dpt'];
            $dpt = M('Depart');
            $dd = $dpt->where("id=$dptid")->find();
            $data['fdpt'] = $dd['fid'];

            // echo 'addsubmit:'.$data['fdpt'];return;
            //echo I('post.highlight');
            if (I('post.listtop') == 'on') {
                $data['listtop'] = 1;
            } else {
                $data['listtop'] = 0;
            }
            if (I('post.highlight') == 'on') {
                $data['highlight'] = 1;
            } else {
                $data['highlight'] = 0;
            }
            if (I('post.iswechat') == 'on') {
                $data['iswechat'] = 1;
            } else {
                $data['iswechat'] = 0;
            }
            $data['date'] = time();
            //var_dump($data);
            $news->create($data);
            $result = $news->add();
            if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('新增成功', U('Admin/Doc/index', array('id' => $data['nid'])));
            } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('新增失败');
            }

        }

    }

    public function edit()
    {
        //对栏目进行选择
        $model = M("Nav");
        $navlist = $model->select();
//        print_r ($navlist);return;
        foreach ($navlist as $nvalue) {
            $model = M("newsclass");
            $navid = $nvalue['id'];
            $classlist = $model->where('fid=0 and typeid!=2 and typeid!=3 and navid=%d', $navid)->select();

            foreach ($classlist as $value) {
                $cid = $value['id'];
                $list = $model->where('typeid!=2 and typeid!=3 and fid=%d and navid=%d', $cid, $navid)->select();
                $cl = array('f' => $value, 'c' => $list);
                $result[] = $cl;
            }
            $c2 = array('nav' => $nvalue, 'navlist' => $result);
            $result1[] = $c2;
            unset($result);
        }

        $this->assign("classlist", $result1);
        //对新闻进行选择
        $id = I('param.id');
        $model = M("news");
        $result = $model->where('id=%d', $id)->select();
        // print_r($result);
        $this->assign("news", $result[0]);
        if ($result[0][listtop] == "1") {
            $this->assign("listtop", "checked");
        }
        if ($result[0][highlight] == "1") $this->assign("highlight", "checked");
        if ($result[0][photo] != "") $this->assign("photo", "checked");
        if ($result[0][iswechat] == "1") $this->assign("iswechat", "checked");

        $this->display();
    }

    public function update()
    {
        if (IS_POST) {
            $news = M("news");
            $id = I('post.id');
            $data['content'] = I('post.myconten');
            $data['title'] = I('post.title');
            $data['author'] = I('post.author');
            $data['keyword'] = I('post.keyword');
            $data['excerpt'] = I('post.excerpt');
            $data['updatetime'] = time(I('post.updatetime'));
            $data['copyfrom'] = I('post.copyfrom');
            $data['photo'] = I('post.photo');
            $data['nid'] = I('post.nid');
            //echo "nid:".$data['nid'];return ;
            //echo I('post.highlight');
            //echo I('post.iswechat');return;
            if (I('post.listtop') == 'on') {
                $data['listtop'] = 1;
            } else {
                $data['listtop'] = 0;
            }
            if (I('post.highlight') == 'on') {
                $data['highlight'] = 1;
            } else {
                $data['highlight'] = 0;
            }
            if (I('post.iswechat') == 'on') {
                $data['iswechat'] = 1;
            } else {
                $data['iswechat'] = 0;
            }
            //var_dump($data);
            $result = $news->where('id=%d', $id)->save($data);;
            if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('修改成功', U('Admin/Doc/index', array('id' => $data['nid'])));
            } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('修改失败');
            }

        }

    }

    public function del()
    {
        $id = I('param.id');
        $model = M('news');
        $result = $model->delete($id);
        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('删除成功', U('Admin/Doc/index'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('删除失败');
        }

    }

    public function delallOrSort()
    {
        $delall = I('param.delall');
        $sort = I('param.sort');
        $ids = join(",", I('param.ids'));
        $listorder = I('param.listorder');
        //  var_dump($listorder);
        foreach ($listorder as $key => $val) {
            $list[]['id'] = $key;
            $list[]['listorder'] = $val;
        }
        //排序

        $model = M('news');
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
            $result = $model->where("id in ($ids)")->delete();
        }
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