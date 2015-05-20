<?php
namespace Admin\Controller;

use Think\Controller;

class MainController extends CommonController
{

    public function index()
    {
        //文档统计 和 文档信息
        $model = M("Nav");
        $navlist = $model->select();
//        print_r ($navlist);return;
        foreach ($navlist as $nvalue) {
            $model = M("newsclass");
            $navid = $nvalue['id'];
            $classlist = $model->where('fid=0 and navid=%d', $navid)->order("listorder asc")->select();

            foreach ($classlist as $value) {
                $cid = $value['id'];
                $list = $model->where('fid=%d and navid=%d', $cid, $navid)->order("listorder asc")->select();
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

            $c2 = array('nav' => $nvalue, 'navlist' => $result);
            $result1[] = $c2;
            unset($result);
        }
        $this->assign("list", $result1);


        $admin = M('admins');
        $ulist = $admin->where('id=%d', I('session.uid'))->field('name,id')->select();
        $this->assign("user", $ulist[0]);


        //RBAC控制对菜单进行显示/隐藏
        if($_SESSION['superadmin']){
            $doc = $newsclass = $message = $depart  = $wechat = $rbac = $setting = true;
        }else{
            $accesslist = $_SESSION['_ACCESS_LIST'];
            foreach($accesslist['ADMIN'] as $key => $value){
                $navclass[] = $key;
//                foreach($value as $key1 => $value1){
//                    $actions[$key][] = $key1;
//                }//这里暂时用不到这么详细
            }
            //dump($accesslist);
            //dump($navclass);
            // dump($actions);
            $navs = join(',',$navclass);//筛选出的信息加入字符串
            $navs = "EWEBCMS". $navs;//前面补上一个字符串.为了防止下面找到的字符串位置是0,也是false

            $doc = strpos($navs,'DOC') ;
            $newsclass = strpos($navs,'NEWSCLASS');
            $message = strpos($navs,'MESSAGE');
            $depart = strpos($navs,'DEPART');
            $setting = strpos($navs,'SETTING');
            $wechat = strpos($navs,'WECHAT');
            $rbac = strpos($navs,'RBAC');
        }

        //将rbac筛选出的信息返回前台
        $this -> assign("doc",$doc);
        $this -> assign("newsclass",$newsclass);
        $this -> assign("message",$message);
        $this -> assign("depart",$depart);
        $this -> assign("setting",$setting);
        $this -> assign("wechat",$wechat);
        $this -> assign("rbac",$rbac);

        $this->display();
    }

    public function datashow()
    {
        //dump($_SESSION); //打印session测试
        //部门统计信息

        $tt = time();
        $time = array(
            'week' => $tt-604800,//一周之前
            'month' => $tt-2678400,//一月之前
            'year' => $tt-31536000,//一年之前的时间戳
        );

        $model = D('User');
        $list = $model->where('admins.id=%d', I('session.uid'))->select();

        foreach($time as $key => $val){//对年.月.周分别统计  放入$result[][]

            //统计文档信息
            $this->assign('user', $list[0]);
            $news = M('news');
            $newsnum[$key] = $news-> where("date>$val")->count();

    //        echo $tt;
            //部门统计信息
            $model = M("Depart");
            $classlist = $model->where('fid=0')->select();

            foreach ($classlist as $value) {
                $cid = $value['id'];
                $list = $model->where('fid=%d', $cid)->select();
                //如果有子类的话，将子类新闻的数量添加进行，重新组合数组。
                $newsModel = M("News");
                $fnumber = $newsModel->where("dpt=$cid and date>$val")->count();
                $value['fnumber'] = $fnumber;//这句应该注意.....push给谁
                if ($list) {
                    foreach ($list as $value2) {
                        $newsModel = M("news");
                        $cnumber = $newsModel->where("dpt=$value2[id] and date>$val")->count();
                        $value2['cnumber'] = $cnumber;//这句应该注意.....push给谁
                        $resultlist[] = $value2;
                    }
                    $cl = array('f' => $value, 'c' => $resultlist);
                    $result[$key][] = $cl;
                } else {
                    $cl = array('f' => $value, 'c' => $list);
                    $result[$key][] = $cl;
                }
                unset($resultlist);
            }

            //dump($result);return;

            //统计人员发布信息
            $user = M("Admins");
            $userlist = $user -> select();
           // dump($userlist);return;
            foreach($userlist as $val1){
                $id = $val1['id'];
                $name = $val1['name'];
                $unumber[$key][$name] = $newsModel -> where("uid=$id and date>$val") -> count();
            }

        }
       // dump($newsnum);
       // dump($result);
//        dump($result);return;
       //dump($unumber);return;
        $allnum = M('News') -> count();
        $this->assign("allnum",$allnum);
        $this->assign("newsnum", $newsnum);
        $this->assign("dptlist", $result);
        $this->assign("usernum", $unumber);

        //print_r($result);return;
        $this->display();

    }

    public function infoshow()
    {
        $mysql = mysql_get_server_info();
        $mysql = empty($mysql) ? "未知" : $mysql;
        //服务器信息
        $info = array(
            '操作系统' => PHP_OS,
            '运行环境' => $_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式' => php_sapi_name(),
            'MYSQL版本' => $mysql,
            '上传附件限制' => ini_get('upload_max_filesize'),
            '执行时间限制' => ini_get('max_execution_time') . "秒",
            '剩余空间' => round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M',
        );
        $this->assign('server_info', $info);
        $this->display();
    }

    public function infoshow2(){
        $model = D('User');
        $list = $model->where('admins.id=%d', I('session.uid'))->select();

        //统计文档信息
        $this->assign('user', $list[0]);
        $news = M('news');
        $newsnum = $news->count();
        $newsadd = $news->where('date>%d', $list[0][ldate])->count();
        $newsclass = M('newsclass');
        $classnum = $newsclass->where('fid!=0')->count();
        $this->assign("newsnum", $newsnum);
        $this->assign("classnum", $classnum);
        $this->assign("newsadd", $newsadd);
        //统计留言信息
        $news = M('Message');
        $msgnum = $news->count();
        $msgadd = $news->where('date>%d', $list[0][ldate])->count();
        $this->assign("msgnum", $msgnum);
        $this->assign("msgadd", $msgadd);

        $this -> display();
    }

    public function copyright()
    {
        $this->display();
    }

    public function outlogin()
    {
        if (Get_user_out() == "SUCC") $this->success("退出成功！", U('Admin/Index/index'));
    }

}