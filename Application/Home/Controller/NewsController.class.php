<?php
/**
 * Created by PhpStorm.
 * User: hezhaoyang
 * Date: 5/13/2015
 * Time: 3:16 PM
 */
namespace Home\Controller;
use Think\Controller;
class NewsController extends CommonController {

    public function index(){
        $this -> display();
    }

    public function newslist(){
                $id = I("param.id");
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

//        dump($newslist);return;


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



        $this -> display();
    }

    public function show(){
        $id = I("param.id");
        $news = M('News');

        //选择新闻
        $newsinfo = $news -> where("id=$id")->find();
        $newsinfo['content'] = html_entity_decode($newsinfo['content']);

        $data['clickrate'] = $newsinfo['clickrate'] + 1; //新闻点击量加1
        $news -> where("id=$id") -> save($data);

        $this -> assign("news",$newsinfo);//新闻返回前台

        //文章列表页左边导航
        $nid = $news -> where("id=$id") -> getField('nid');
        $navleft = M("Newsclass");
        $current = $sidef = $navleft -> where("id=$nid") -> find();
        if($sidef['fid']!=0){
            $nid = $sidef['fid'];
            $sidef = $navleft -> where("id=$sidef[fid]") -> find();

        }
        $sidec = $navleft -> where("fid=$nid") -> select();

        $this -> assign("sidef", $sidef);
        $this -> assign("current", $current);
        $this -> assign("sidec", $sidec);//左边导航完成
//
//        $id = I('param.id');
//        echo $id;
        $this -> display();
    }


}