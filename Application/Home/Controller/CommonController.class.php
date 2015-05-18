<?php
/**
 * Created by PhpStorm.
 * User: hezhaoyang
 * Date: 2015/5/13
 * Time: 20:39
 */
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller
{
    public function _initialize()
    {
        //导航部分
        $nav = M("Nav");
        $navid = $nav->order('id asc')->field("id")->select();
        $model = M("Newsclass");
        foreach ($navid as $val) {
            $navlist[] = $model->where("display=1 and fid=0 and navid=$val[id]")->order("listorder asc")->select();
        }
        foreach ($navlist as $navlist1) {
            foreach ($navlist1 as $value) {
                $cid = $value['id'];
                $list = $model->order('listorder asc,id')->where('display=1 and fid=%d', $cid)->select();
                //如果有子类的话，将子类新闻的数量添加进行，重新组合数组。
                if ($list) {
                    foreach ($list as $value2) {
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
            $result1[] = $result;
            unset($result);
        }

        //dump($result1); return;
        // dump($result1[0]);return;
        $this->assign("navlist", $result1);//导航部分完成
    }

    public function pagesideleft($id){
        //文章列表页左边导航
        $navleft = M("Newsclass");
        $current = $sidef = $navleft -> where("page_id=$id") -> find();
        if($sidef['fid']!=0){
            $nid = $sidef['fid'];
            $sidef = $navleft -> where("id=$sidef[fid]") -> find();

        }
        $sidec = $navleft -> where("fid=$nid")-> order("listorder asc") -> select();

        $this -> assign("sidef", $sidef);
        $this -> assign("current", $current);
        $this -> assign("sidec", $sidec);//左边导航完成
    }

}