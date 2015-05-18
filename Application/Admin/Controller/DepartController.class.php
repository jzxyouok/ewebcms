<?php
/**
 * Created by PhpStorm.
 * User: hezhaoyang
 * Date: 4/27/2015
 * Time: 4:39 PM
 */
namespace Admin\Controller;

use Think\Controller;

class DepartController extends CommonController
{
    public function index()
    {
        //把部门从表中选出   并分父级'f' 和 子级'c'
        $model = M("Depart");
        $classlist = $model->where('fid=0')->select();

        foreach ($classlist as $value) {
            $cid = $value['id'];
            $list = $model->where('fid=%d', $cid)->select();
            //如果有子类的话，将子类新闻的数量添加进行，重新组合数组。
            $newsModel = M("News");
            $fnumber = $newsModel->where('fdpt=%d', $cid)->count();
            $value['fnumber'] = $fnumber;//这句应该注意.....push给谁
            if ($list) {
                foreach ($list as $value2) {
                    $newsModel = M("news");
                    $cnumber = $newsModel->where('dpt=%d', $value2['id'])->count();
                    $value2['cnumber'] = $cnumber;//这句应该注意.....push给谁
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
        //返回前台
        $this->assign("editurl", U('Admin/Depart/edit'));
        $this->assign("delurl", U('Admin/Depart/del'));
        $this->assign("list", $result);
        $this->display();
    }


    public function add()
    {
        $model = M("Depart");
        $dptlist = $model->field('id,name')->where("fid=0")->select();
        // print_r($dptlist);return;
        $this->assign("dptlist", $dptlist);
        $this->display();
    }

    public function addsubmit()
    {
        $data = I('param.');
        //print_r($data);return;
        $model = M('Depart');
        $result = $model->add($data);

        if ($result) {
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('新增成功', U('Admin/Depart/index'));
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('新增失败', U('Admin/Depart/add'));
        }

    }

    public function edit()
    {
        $id = I('param.id');
        $model = M("Depart");
        $list = $model->where("id=$id")->find();
        //print_r($list);return;
        $this->assign("dpt", $list);
        $dptlist = $model->where("fid=0")->select();
        $this->assign("dptlist", $dptlist);
        $this->display();
    }

    public function update()
    {
        $data = I('param.');
        $id = $data['id'];
        //print_r($data);return;
        $model = M("Depart");
        $result = $model->where("id=$id")->save($data);

        //该父栏目的子类也应该加入该栏目下 因为现在只支持两级菜单
        if (I('post.fid') != 0) {
            $data1['fid'] = I('fid');
            $model->where("fid=$id")->save($data1);
        }

        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('修改成功', U('admin/Depart/index'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('修改失败或者没有做任何改变', U('admin/Depart/index'));
        }

    }

    public function del()
    {
        $id = I("param.id");
        $model = M("Depart");
        $result = $model->where("id=$id")->delete();

        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('删除成功', U('Admin/Depart/index'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('删除失败', U('Admin/Depart/index'));
        }
    }

}