<?php
/**
 * Created by PhpStorm.
 * User: hezhaoyang
 * Date: 4/28/2015
 * Time: 6:24 PM
 */
namespace Admin\Controller;

use Think\Controller;

define ('TOKEN','mywechat');//定义微信token


class WechatController extends CommonController
{
    var $wechat;
    public function _initialize(){
        $model = M('Wx_appid');
        $info = $model -> select();
        $appid = $info[0]['appid'];
        $appsecret = $info[0]['appsecret'];
        $userdata['appid'] = $appid;
        $userdata['appsecret'] = $appsecret;
        $this -> wechat = new \Org\Util\Wechat($userdata);
    }

    //微信连接接口
    public function wechat(){

        //echo $wechatObj -> test();
        if(isset($_GET['echostr'])){
            $this -> valid();
        }else{
            $this -> responseMsg();
        }
    }

    //检验签名
    public function valid(){
        $echostr = $_GET['echostr'];
        if($this -> checkSignature()){
            echo $echostr;
            exit;
        }
    }
    //验证签名
    private function checkSignature(){
        $signature = $_GET['signature'];
        $timestamp = $_GET['timestamp'];
        $nonce = $_GET['nonce'];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if($tmpStr == $signature){
            return ture;
        }else{
            return false;
        }
    }


    public function index()
    {
        $this->show("微信管理首页面");
    }

    //微信端留言板
    public function liuyan(){
        $this -> display();
    }

    public function liuyansubmit(){
        $data=I('param.');
        $data['date']=time();
        $model = M('wx_msg');
        $result = $model -> add($data);
        if($result){
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('留言成功',$_SERVER['HTTP_REFERER']);
        }else{
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('留言失败',$_SERVER['HTTP_REFERER']);
        }

    }
    //微信端留言板展示
    public function liuyanshow(){
        //选择留言
        $message = M("Message");
        $count = $message -> where("display=1") -> count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $msglist = $message->order('replydate desc')->where("display=1")->limit($Page->firstRow . ',' . $Page->listRows)->select();

        $this -> assign("page",$show);
        $this -> assign("msglist", $msglist);
        //选择留言完成
        $this -> display();
    }



    public function guestbook()
    {
        $type = I('param.type');
        $model = M('wx_msg');
        if ($type == 0) {
            $count = $model->where('status=0')->count();// 查询满足要求的总记录数
        } elseif ($type == 1) {
            $count = $model->where()->count();// 查询满足要求的总记录数
        }

        $Page = new \Think\Page($count, 25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        if ($type == 0) {
            $newslist = $model->order('id desc')->field('id,name,title,date,phone,status,content,reply')->where('status=0')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        } elseif ($type == 1) {
            $newslist = $model->order('id desc')->field('id,name,title,date,phone,status,content,reply')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        }


        $this->assign("page", $show);
        $this->assign("list", $newslist);
        $this->assign("replyurl", U('Admin/Wechat/reply'));
        $this->assign("delurl", U('Admin/Wechat/del'));
        $this->assign("delallurl", U('Admin/Wechat/delall'));
        $this->display();
    }


    public function reply()
    {
        $id = I('param.id');
        $model = M('wx_msg');
        $list = $model->where('id=%d', $id)->select();
        $this->assign("list", $list[0]);
        $this->display();
    }

    public function replysubmit()
    {
        if (IS_POST) {
            $data['id'] = I('post.id');
            if (I('post.reply') != "") {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            $data['reply'] = I('post.reply');
        }
        $model = M('wx_msg');
        $result = $model->save($data);
        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('回复成功', U('Admin/Wechat/guestbook', array('type' => 1)));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('回复失败', $_SERVER['HTTP_REFERER']);
        }

    }

    public function del()
    {
        $id = I('param.id');
        $model = M('wx_msg');
        $result = $model->delete($id);
        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('删除成功', U('Admin/Wechat/guestbook', array('type' => 1)));
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('删除失败', U('Admin/Wechat/guestbook', array('type' => 1)));
        }
    }

    public function delall()
    {
        $delall = I('param.delall');
        if ($delall) {
            //删除全部
            $model = M('wx_msg');
            $ids = join(",", I('param.ids'));
            $result = $model->where("id in ($ids)")->delete();

            if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('删除成功', U('Admin/Wechat/guestbook', array('type' => 1)));
            } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('删除失败', U('Admin/Wechat/guestbook', array('type' => 1)));
            }
        }
    }

    /*******************************************************************************************************************************
     * *微信开发
     */


    public function connect(){
        $access_token = $this -> wechat -> get_access_token();//测试连接微信
        $model = M('Wx_appid');
        $list = $model -> select();
        $this -> assign("access_token",$access_token);
        $this -> assign('list',$list[0]);
        $this -> display();
    }

    public function connectsubmit(){
        $model = M("Wx_appid");
        $data = I('param.');
        $data['date'] = time();
        $count = $model -> count();
        if(!$count){//如果表中没有数据,则添加新数据
            $result = $model -> add($data);
        }else{//如果表中有数据,则改变选择出的第一条数据
            $list = $model -> select();
            $id = $list[0]["id"];
            $result = $model -> where("id=$id") -> save($data);
        }

        if ($result) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('设置成功');
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('设置失败或者没有做任何改变');
        }

    }

    //获取用户列表
    public function userlist(){

        $model = M('wx_user');
        //把数据进行分页
        $count = $model -> where('status=1') -> count();
        $ucount = $model -> where('status=0') -> count();
        $Page = new \Think\Page($count, 15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出

        $userlist = $model->where('status=1')->order('subscribe_time desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign("page", $show);
        $this->assign("userlist", $userlist);
        $this -> assign("count",$count);
        $this -> assign("ucount",$ucount);
       // dump($result['data']);
        //dump($res);
        $this -> display();

    }
    //获取用户信息
    public function userinfo(){
        dump($this -> wechat -> get_user_info(o4J0Et_OlZ5N1F1XgUr2PuBQoJ3g));
    }
    //创建菜单
    public function createmenu(){
        $this -> display();
    }

    public function menusubmit(){
        $menudata = $_POST['menudata'];
//        echo $menudata;return;

        $result = $this -> wechat -> create_menu($menudata);

        if ($result['errcode'] == 0) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('设置成功,重新关注公众号或24小时后生效',U("Admin/Wechat/createmenu"),3);
        } else {  //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error($result['errmsg']."<br/>无效的证书,access_token无效或不是最新<br/>请尝试重新登录系统后台...",U("Admin/Index/index"));
        }

    }

    //获取菜单
    public function getmenu(){
        $result = $this -> wechat -> get_menu();
        if($result['errcode']){
           $this -> error($result['errmsg']."<br/>无效的证书,access_token无效或不是最新<br/>请尝试重新登录系统后台...",U("Admin/Index/index"));
        }

        $json_res = json_encode($result, JSON_UNESCAPED_UNICODE);
        $result = $result['menu']['button'];
        $count = count($result);

        for($i = 0; $i < $count; $i++){
            $nav = $result[$i];
            $button[$i]['f']['name'] = $nav['name'];
            foreach($nav['sub_button'] as $value){
                $button[$i]['c'][] = array(
                    'type' => $value['type'],
                    'name' => $value['name'],
                    'key' => $value['key'],
                    'url' => $value['url'],
                );
            }
        }
        //dump($button);
        $this -> assign("list",$button);
        $this -> assign("json",$json_res);
        $this -> display();

    }

    //显示收到的消息,(客服接口)
    public function msgreply(){
        $model = M("Wx_custom");
        $type = I('param.type');
        if ($type == 0) {
            $count = $model->where('status=0')->count();// 查询满足要求的总记录数
        } elseif ($type == 1) {
            $count = $model->where()->count();// 查询满足要求的总记录数
        }

        //把数据进行分页
        $Page = new \Think\Page($count, 20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        if ($type == 0) {
            $list = $model->order('id desc')->where('status=0')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        } elseif ($type == 1) {
            $list = $model->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        }

        $c = count($list);
        for($i=0;$i<$c;$i++){
            $openid = $list[$i]['openid'];
            $info =  $this -> wechat -> get_user_info($openid);//获取用户信息
            $list[$i]['nickname'] = $info['nickname'];
            $list[$i]['headimgurl'] = $info['headimgurl'];
        }

        $this -> assign("page",$show);
        $this -> assign("list",$list);
        $this -> assign("count",$count);

        $this -> assign("replyurl",U('Admin/wechat/replycustom'));
        $this -> assign("delurl",U('Admin/wechat/delcustom'));
        $this -> display();
    }

    //回复客服消息
    public function replycustom(){
        $id = I('param.id');
        //获取留言信息
        $model = M('Wx_custom');
        $list = $model -> where("id=$id") -> find();

        //获取昵称信息
        $info =  $this -> wechat -> get_user_info($list['openid']);//获取用户信息
        $list['nickname'] = $info['nickname'];
        $list['headimgurl'] = $info['headimgurl'];

        $this->assign("list", $list);
        $this->display();
    }

    //回复消息提交
    public function replycustomsubmit(){
        $id = I('param.id');
        $openid = I('param.openid');
        //保存到本地数据库
        $data['reply'] = I('param.reply');
        $data['status'] = 1;
        $result  = M('wx_custom') -> where("id=$id") -> save($data);

        //给用户发送消息
        $res = $this -> wechat -> send_custom_message($openid, 'text',$data['reply']);
        if($res['errcode']!=0){
            $this -> error($result['errmsg']."<br/>无效的证书,access_token无效或不是最新<br/>请尝试重新登录系统后台...",U("Admin/Index/index"));
        }
        if($result){
            $this -> success('回复成功',U('Admin/Wechat/msgreply',array('type' => 1)));
        }else{
            $this -> error('回复失败',U('Admin/Wechat/msgreply',array('type' => 1)));
        }

    }

    //删除客服消息
    public function delcustom(){
        $id = I("param.id");
        $result = M('Wx_custom') -> where("id=$id") -> delete();
        if($result){
            $this -> success('删除成功',U('Admin/Wechat/msgreply',array('type' => 1)));
        }else{
            $this -> error('删除失败',U('Admin/Wechat/msgreply',array('type' => 1)));
        }

    }



    //回复消息
    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)) {

            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj -> MsgType);

            switch ($RX_TYPE) {
                case "text":
                    //简单回复文本消息
                   // $resultStr = $this -> receiveText($postObj);
                    //客服接口回复消息
                    $resultStr = $this -> userCustom($postObj);
                    break;
                case "voice":
                    $resultStr = $this -> receiveVoice($postObj);
                    break;
                case "image":
                    $resultStr = $this -> receiveImage($postObj);
                    break;
                case "event":
                    $resultStr = $this -> receiveEvent($postObj);
                    break;
                default:
                    $resultStr = "";
            }

            echo $resultStr;
        }
    }

    /***
     *  客服接口开发
     */
    private function userCustom($postObj, $funcFlag = 0){
        $fromUserName = $postObj -> FromUserName;
        $toUserName   = $postObj -> toUserName;
        $keyword      = $postObj -> Content;
        $time         = time();
        $MsgType      = "text";

        $model = M('Wx_custom');
        $data['openid']  = "$fromUserName";
        $data['date']    = time();
        $data['content'] = "$keyword";
        $data['status']  = 0;


        $result =  $model -> add($data);
        if(!$result){
            $resultStr = $this -> transmitText($postObj,"cuowu");
               return $resultStr;
        }

        $content = "谢谢你的留言,我们会尽快回复...";
        $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
                        </xml>";

        $resultStr = sprintf($textTpl, $fromUserName, $toUserName, $time, $MsgType, $content, $funcFlag);

        return $resultStr;

    }



    private function transmitText($postObj, $contentStr, $funcFlag = 0){
        //把5叫过来的字符串转化为微信服务器可以识别的模板
        $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
                        </xml>";
        $msgType = "text";
        $resultStr = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, time(), $msgType, $contentStr, $funcFlag);
        return $resultStr;
    }

    //把内容转换为微信新闻格式返回
    private function transmitNews($postObj, $arr_item, $funcFlag = 0)
    {
        //首条标题28字，其他标题39字
        if(!is_array($arr_item))
            return $this -> transmitText($postObj, $arr_item);

        $itemTpl = "    <item>
								        <Title><![CDATA[%s]]></Title>
								        <Description><![CDATA[%s]]></Description>
								        <PicUrl><![CDATA[%s]]></PicUrl>
								        <Url><![CDATA[%s]]></Url>
								    </item>
								";
        $item_str = "";
        foreach ($arr_item as $item)
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);

        $newsTpl = "<xml>
									<ToUserName><![CDATA[%s]]></ToUserName>
									<FromUserName><![CDATA[%s]]></FromUserName>
									<CreateTime>%s</CreateTime>
									<MsgType><![CDATA[news]]></MsgType>
									<Content><![CDATA[]]></Content>
									<ArticleCount>%s</ArticleCount>
									<Articles>$item_str</Articles>
									<FuncFlag>%s</FuncFlag>
								</xml>";

        $resultStr = sprintf($newsTpl, $postObj->FromUserName, $postObj->ToUserName, time(), count($arr_item), $funcFlag);
        return $resultStr;
    }

    private function receiveEvent($postObj){
        $contentStr = "";
        switch ($postObj -> Event)
        {
            case "subscribe":

                //用户信息写入数据库
                $model = M('Wx_user');
                $openid = $postObj -> FromUserName;
                $info = $this -> wechat -> get_user_info($openid);
                $data['openid'] = "$openid";
                $data['nickname'] = $info['nickname'];
                $data['city'] = $info['country']." ".$info['province']." ".$info['city'];
                $data['headimgurl'] = $info['headimgurl'];
                $data['subscribe_time'] = time();
                $data['status'] = 1;
                $result = $model -> add($data);

                if(!$result){
                    $model -> save($data);
                }
                $contentStr = '欢迎关注学院公众号';
                break;
            case "unsubscribe":
                //从微信用户表中删除该用户信息
                $openid = $postObj -> FromUserName;
                $model = M('Wx_user');
                $openid = "$openid";
                $data['openid'] = $openid;
                $data['nickname'] = $openid;
                $data['status'] = 0;
                $model -> save($data);
                break;
            case "CLICK":
                //$mysql = new SaeMysql();
                $newslisturl = "http://1.hitwhxgc.sinaapp.com/index.php/Home/Wechat/newslist/id/";
                $newsshowurl = "http://1.hitwhxgc.sinaapp.com/index.php/Home/Wechat/show/id/";
                $pageurl     = "http://1.hitwhxgc.sinaapp.com/index.php/Home/Page/index/id/";
                switch ($postObj->EventKey)
                {
                    //第一个底部菜单筛选院系信息

                    case "JGSZ"://机构设置
                        $model = M('Info');
                        $list = $model -> where("name='JGSZ'") -> find();
                        $contentStr[] = array(
                            "Title" => $list['title'],
                            "Description" => $list['excerpt'],
                            "PicUrl"      => "http://img9.3lian.com/c1/vector3/02/76/d/23.jpg",
                            "Url"         => "{$pageurl}"."47.html",
                        );
                        break;

                    case "RYJS"://人员介绍
                        $model = M('Info');
                        $list = $model -> where("name='RYJS'") -> find();
                        $contentStr[] = array(
                            "Title" => $list['title'],
                            "Description" => $list['excerpt'],
                            "PicUrl"      => "http://img9.3lian.com/c1/vec2013/7/48.jpg",
                            "Url"         => "{$pageurl}"."46.html",
                        );
                        break;

                    case "LXFS"://联系方式
                        $model = M('Info');
                        $list = $model -> where("name='LXFS'") -> find();
                        $contentStr[] = array(
                            "Title" => $list['title'],
                            "Description" => $list['excerpt'],
                            "PicUrl"      => "http://pic.58pic.com/58pic/16/81/72/74h58PICVir_1024.jpg",
                            "Url"         => "{$pageurl}"."50.html",
                        );
                        break;



                    //第二个底部菜单筛选新闻
                    case "XGXW":
                        $id = 121;
                        $model = M('News');
                        $list = $model -> where("iswechat=1 and nid=$id") -> order('date desc') -> limit(5) -> select();
                        $count = count($list);
                        for($i = 0; $i < $count; $i++){
                            $contentStr[$i] = array(
                                "Title" => $list[$i]['title'],
                                "Description" => $list[$i]['excerpt'],
                                "PicUrl"      => "http://img9.3lian.com/c1/vec2013/7/48.jpg",
                                "Url"         => "{$newsshowurl}{$list[$i]['id']}",
                            );
                        }
                        $contentStr[$i] = array(
                            "Title" => "查看更多",
                            "Description" => "",
                            "PicUrl"      => "http://pic.58pic.com/58pic/16/81/72/74h58PICVir_1024.jpg",
                            "Url"         => "{$newslisturl}{$id}",
                        );
                        break;


                    case "TZGG":
                        $id = 122;
                        $model = M('News');
                        $list = $model -> where("iswechat=1 and nid=$id") -> order('date desc') -> limit(5) -> select();
                        $count = count($list);
                        for($i = 0; $i < $count; $i++){
                            $contentStr[$i] = array(
                                "Title" => $list[$i]['title'],
                                "Description" => $list[$i]['excerpt'],
                                "PicUrl"      => "http://img9.3lian.com/c1/vector3/02/76/d/23.jpg",
                                "Url"         => "{$newsshowurl}{$list[$i]['id']}",
                            );


                        }
                        $contentStr[$i] = array(
                            "Title" => "查看更多",
                            "Description" => "",
                            "PicUrl"      => "http://img9.3lian.com/c1/vec2013/7/48.jpg",
                            "Url"         => "{$newslisturl}{$id}",
                        );
                        break;

                    case "WSJC":
                        $id = 123;
                        $model = M('News');
                        $list = $model -> where("iswechat=1 and nid=$id") -> order('date desc') -> limit(5) -> select();
                        $count = count($list);
                        for($i = 0; $i < $count; $i++){
                            $contentStr[$i] = array(
                                "Title" => $list[$i]['title'],
                                "Description" => $list[$i]['excerpt'],
                                "PicUrl"      => "http://pic.58pic.com/58pic/16/81/72/74h58PICVir_1024.jpg",
                                "Url"         => "{$newsshowurl}{$list[$i]['id']}",
                            );
                        }
                        $contentStr[$i] = array(
                            "Title" => "查看更多",
                            "Description" => "",
                            "PicUrl"      => "http://img9.3lian.com/c1/vector3/02/76/d/23.jpg",
                            "Url"         => "{$newslisturl}{$id}",
                        );
                        break;


                    default:
                        $contentStr[] = array("Title" =>"默认菜单回复",
                            "Description" =>"您正在使用测试接口",
                            "PicUrl" =>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg",
                            "Url" =>"");
                        break;
                }
                break;
            default:
                break;

        }
        if (is_array($contentStr)){
            $resultStr = $this->transmitNews($postObj, $contentStr);
        }else{
            $resultStr = $this->transmitText($postObj, $contentStr);
        }
        return $resultStr;
    }


    private function receiveVoice($postObj)
    {
        //当收到语音时,不仅对文本进行识别 ,而且提交百度翻译进行翻译,而且通过tts-api获取语音
        $recognition = $postObj->Recognition;
        //baidu翻译
        $tranurl = "http://openapi.baidu.com/public/2.0/bmt/translate?client_id=04ryebAMfvVpw33lVNFpsWYB&q={$recognition}&from=auto&to=auto";
        $transtr = file_get_contents($tranurl);
        $transon = json_decode($transtr);
        $content = $transon -> trans_result[0] -> dst;
        $contentStr = urlencode($content);
        //获取语音文件
        $ch = curl_init();
        $url = "http://tts-api.com/tts.mp3?q={$contentStr}&return_url=1";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $mp3url = curl_exec($ch);

        $fromUserName  = $postObj -> FromUserName;
        $toUserName = $postObj -> ToUserName;
        $time = time();

        $musictpl = "<xml>
                            <ToUserName>$fromUserName</ToUserName>
                            <FromUserName>$toUserName</FromUserName>
                            <CreateTime>$time</CreateTime>
                            <MsgType>music</MsgType>
                            <Music>
                                <Title>$recognition</Title>
                                <Description>$content</Description>
                                <MusicUrl>$mp3url</MusicUrl>
                                <HQMusicUrl>$mp3url</HQMusicUrl>
                            </Music>
                        </xml>";

        return $musictpl;
        //简单回复语音内容
//            $contentStr = "the voice is : " . $recognition;
//            $resultStr = $this -> transmitText($postObj, $mp3url);
//            return $resultStr;
    }


    private function receiveImage($postObj){
        //当收到图片时,存入sae的storage库,并提醒保存成功
        $token = Get_token();

        $MediaId = $postObj -> MediaId;
        $image = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token={$token}&media_id={$MediaId}";

        $file = file_get_contents($image);
        $name = time(). ".jpg";
        $s = new SaeStorage();
        $s -> write('upload', $name, $file);

        $resultStr = $this -> transmitText($postObj, "the picture have been saved....");//提示保存成功
        return $resultStr;

    }



    private function receiveText($postObj){
        //当收到文本消息时的处理
        $content = $postObj -> Content;

          $contentStr = "the text is : " . $content;
          $resultStr = $this -> transmitText($postObj, $contentStr);
          return $resultStr;
    }


}