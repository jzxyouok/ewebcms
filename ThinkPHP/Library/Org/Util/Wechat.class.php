<?php
/**
 * Created by PhpStorm.
 * User: hezhaoyang
 * Date: 5/5/2015
 * Time: 11:03 PM
 */
namespace Org\Util;
class Wechat{
    var $appid = "";
    var $appsecret = "";

    //构造函数 ,获取access_token
    public function __construct($userdata){
        $appid = $userdata['appid'];
        $appsecret = $userdata['appsecret'];
        if($appid){
            $this -> appid = $appid;
        }
        if($appsecret){
            $this -> appsecret = $appsecret;
        }

        if((time()>=($_SESSION['accesstime'] + 300))||$_SESSION['gettoken']==1){
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this -> appid."&secret=".$this -> appsecret;
            $res = $this -> https_request($url);
            $result = json_decode($res,true);
            $_SESSION['accesstoken'] = $result['access_token'];//把access_token保存到session
            $_SESSION['accesstime'] = time();
            $_SESSION['gettoken']  = 0;
        }
    }

    //获取access_token
    public function get_access_token(){
        echo "time:". time();
        echo "<br/>lasttime:". $_SESSION['accesstime'];
        echo "<br/>access_token:".$_SESSION['accesstoken'];
        echo "gettoken". $_SESSION['gettoken'];

        return $_SESSION['accesstoken'];
    }

    //获取关注者列表
    public function get_user_list($next_openid=NULL){
        $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$_SESSION['accesstoken']."&next_openid=". $next_openid;
        $res = $this -> https_request($url);
        return json_decode($res,true);
    }

    //获取用户基本信息
    public function get_user_info($openid){
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$_SESSION['accesstoken']."&openid=".$openid."&lang=zh_CN";
        $res = $this -> https_request($url);
        return json_decode($res,true);
    }
    //创建菜单
    public function create_menu($data){
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$_SESSION['accesstoken'];
        $res = $this -> https_request($url,$data);
        return json_decode($res, true);
    }
    //获取菜单
    public function get_menu(){
        $url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$_SESSION['accesstoken'];
        $res = $this -> https_request($url);
        return json_decode($res, true);
    }

    //发送客服消息
    public function send_custom_message($touser, $type, $data){
        $msg = array('touser' => $touser);
        switch($type){
            case 'text':
                $msg['msgtype'] = 'text';
                $msg['text'] = array('content'=>urlencode($data));
                break;
        }
        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=". $_SESSION['accesstoken'];
        return $this -> https_request($url, urldecode(json_encode($msg)));
    }

    //用oauth2.0 CODE 换取accesstoken
    public function code_for_accesstoken($code){
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this -> appid}&secret={$this -> appsecret}&code={$code}&grant_type=authorization_code";
        $res = $this -> https_request($url);
        return json_decode($res, true);
    }

    public function https_request($url, $data=NULL){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        if(!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);

        return $output;
    }
}