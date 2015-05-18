<?php
/**
 * 用户权限判断($uid, $shell, $m_id)
 */

//function Get_user_shell($uid, $shell)
//{
//    // $query = $this->select('admins', '*', '`id` = \'' . $uid . '\'');
//    // $us = is_array($row = $this->fetch_array($query));
//    // $shell = $us ? $shell == md5($row[name] . $row[password] . "TKBK") : FALSE;
//    // return $shell ? $row : NULL;
//
//    $model = M('admins');
//    $list = $model->where('id=%d', $uid)->select();
//    $us = is_array($list[0]);
//    $shell = $us ? $shell == md5($list[0][name] . $list[0][password] . "TKBK") : false;
//    return $shell ? $list[0] : NULL;
//
//
//} //end shell

//function Get_user_shell_check($uid, $shell, $where, $level = 10)
//{
//    if ($row = Get_user_shell($uid, $shell)) {
//        $model = D('Level');
//        $list = $model->where('admins.id=%d', $row[id])->select();
//        $clevel = 9;
//        if ($where == "DOC") $clevel = $list[0][doclevel];
//        if ($where == "NCLASS") $clevel = $list[0][classlevel];
//        if ($where == "MESS") $clevel = $list[0][messlevel];
//        if ($where == "MEMB") $clevel = $list[0][memblevel];
//        if ($clevel < $level) {
//            return "SUCC";
//        } else {
//            return "UNP";//无权限
//            exit ();
//        } //end m_id
//    } else {
//        return "UNL";//没有登录
//    }
//} //end shell
//========================================
/**
 * 用户登陆超时时间(秒)
 */
//function Get_user_ontime($long = '3600')
//{
//    $new_time = mktime();
//    $onlinetime = I('session.ontime');
//    $new_time - $onlinetime;
//    if ($new_time - $onlinetime > $long) {
//        session_destroy();
//        return "TIMEOUT";
//        exit ();
//    } else {
//        $_SESSION[ontime] = mktime();
//    }
//}

/**
 * 用户登陆
 */
function Get_user_login($username, $password)
{
    //print_r(I('post.'));
    $username = str_replace(" ", "", $username);
    $iipp = I('server.REMOTE_ADDR');
    $time = mktime();
    $model = M('admins');
    $list = $model->where("username='%s'", $username)->select();
    $us = is_array($row = $list[0]);
    $ps = $us ? md5($password . "EWEBCMS") == $row[password] : FALSE;
    if ($ps) {
        //$sql="update admins set `lastip`='$iipp',`lasttime`='$time' where `id` = '$row[id]';";
        $row['lip'] = $row[cip];
        $row['ldate'] = $row[cdate];
        $row['cip'] = $iipp;
        $row['cdate'] = $time;
        $model->save($row);
        $_SESSION[uid] = $row[id];
        $_SESSION[shell] = md5($row[name] . $row[password] . "TKBK");
        $_SESSION[ontime] = mktime();
        $_SESSION[accesstime] = mktime();//保存微信申请accesstoken时间
        $_SESSION[gettoken] = 1;//可以获取微信accesstoken
        //保存RBAC认证的SESSION
        $_SESSION['logintime'] = time();
        session('username',$username);
        session(C('USER_AUTH_KEY'),$row[id]);
        if($_SESSION['username'] == C('RBAC_SUPERADMIN')){
            session(C('ADMIN_AUTH_KEY'),true);
        }

        $rbac = new \Org\Util\Rbac();
        $rbac -> saveAccessList();

        return "SUCC";//登录成功
    } else {
        return "ERROR";//登录失败
        session_destroy();
    }
}

/**
 * 用户退出登陆
 */
function Get_user_out()
{
    session_destroy();
    return "SUCC";
}


/********************************************************************************************************************
 * 微信获取token
 */

function Get_token(){
    $mmc = memcache_init();
    $token = memcache_get($mmc, "token");
    if(empty($token)) {
        $appid = "wx0e73bcc9a7adff43";
        $secret = "b62ad23267cce5d6ff7677f374ad7f55";
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $a = curl_exec($ch);
        $strjson = json_decode($a);
        $access_token = $strjson -> access_token;
        memcache_set($mmc, "token", $access_token, 0, 7200);
        $token = memcache_get($mmc, "token");

        return $token;
    }
}
?>