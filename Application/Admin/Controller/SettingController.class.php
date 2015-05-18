<?php
/**
 * Created by PhpStorm.
 * User: hezhaoyang
 * Date: 5/5/2015
 * Time: 4:26 PM
 */
namespace Admin\Controller;

use Think\Controller;

class SettingController extends CommonController{
    public function index(){
        echo "111";
    }

    //网站信息设置
    public function infoset(){
        $model = M("Info");
        $list = $model  -> select();

        foreach($list as $val){
            $val['content'] = html_entity_decode($val['content']);
        }

        $this -> assign("list",$list);

        $this -> assign('delurl',U('Admin/Setting/infodel'));
        $this -> assign('editurl',U('Admin/Setting/infoedit'));
        $this -> assign("addurl", U('Admin/Setting/infoadd'));
        $this -> display();
    }

    public function infoaddsubmit(){
        $data['name'] = I('param.name');
        $data['title'] = I('param.title');
        $data['excerpt'] = I('param.excerpt');
        $data['content'] = $_POST['content'];
      //  dump($data);return;
        $model = M('Info');
        $result = $model -> add($data);

        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('添加成功',U('Admin/Setting/infoset'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('添加失败', $_SERVER['HTTP_REFERER'], '2');
        }
    }

    public function infoedit(){
        $id = I('param.id');
        $model = M('Info');
        $info = $model -> where("id=$id") -> find();
        $this -> assign("info",$info);
        $this -> display();
    }

    public function infoupdate(){
        $id = I("param.id");
        $data['name'] = I("param.name");
        $data['excerpt'] = I("param.excerpt");
        $data['title'] = I("param.title");
        $data['content'] = $_POST['content'];

        $model = M("Info");
        $result = $model -> where("id=$id") -> save($data);
        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('更新成功',U('Admin/Setting/infoset'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('更新失败或者没有做任何改变', $_SERVER['HTTP_REFERER'], '2');
        }
    }

    public function infodel(){
        $id = I('param.id');
        $model = M('Info');
        $result = $model -> where("id=$id") -> delete();
        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('删除成功',U('Admin/Setting/infoset'));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('删除失败', $_SERVER['HTTP_REFERER'], '2');
        }
    }

}