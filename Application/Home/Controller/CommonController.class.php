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

    public function selectnews($id){
        //选择新闻
        $news = M("News");

        $ids = "$id";
        if(M("Newsclass") -> where("id=$id") -> getField("fid") == 0){
            $cid = M("Newsclass") -> where("fid=$id") ->field("id") -> select();
            foreach($cid as $val){
                $cids[] = $val['id'];
            }
            $ids = join(",", $cids);
        }

        $count = $news -> where("nid in ($ids)") -> count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $newslist = $news->order('updatetime desc')->where("nid in ($ids)")->field('id,title,updatetime')->limit($Page->firstRow . ',' . $Page->listRows)->select();

        $this->assign("page", $show);
        $this->assign("newslist", $newslist);//新闻部分结束

        //文章列表页左边导航
        $navleft = M("Newsclass");
        $current = $sidef = $navleft -> where("id=$id")-> find();
        if($sidef['fid']!=0){
            $id = $sidef['fid'];
            $sidef = $navleft -> where("id=$sidef[fid]")  -> find();
        }
        $sidec = $navleft -> where("fid=$id")-> order("listorder asc") -> select();

        $this -> assign("sidef", $sidef);
        $this -> assign("current", $current);
        $this -> assign("sidec", $sidec);//左边导航完成
    }

    public function newsshow($id){
        //选择新闻
        $news = M('News');
        $newsinfo = $news -> where("id=$id")->find();
        $newsinfo['content'] = html_entity_decode($newsinfo['content']);

        $data['clickrate'] = $newsinfo['clickrate'] + 1; //新闻点击量加1
        $news -> where("id=$id") -> save($data);

        $this -> assign("news",$newsinfo);//新闻返回前台

    }
}