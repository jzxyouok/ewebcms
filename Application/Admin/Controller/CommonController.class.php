<?php
/**
 * Created by PhpStorm.
 * User: hezhaoyang
 * Date: 5/3/2015
 * Time: 4:01 PM
 */
namespace Admin\Controller;

use Think\Controller;

class CommonController extends Controller
{
    public function _initialize()
    {
        //检查是否登录,没有登录会没有USER_AUTH_KEY
        if (!isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->error('您还没有登录,正在跳转...', U('Admin/Index/index'), 3);
        }

        //登陆超时检查 超过2小时没有操作超时
        $nowtime = time();
        $s_time = $_SESSION['logintime'];
        if (($nowtime - $s_time) > 3600) {
            unset($_SESSION['logintime']);
            $this->error('当前用户登录超时，请重新登录...', U('Admin/Index/index'));
        } else {
            $_SESSION['logintime'] = $nowtime;
        }

        //检查是否进行模块或方法rbac认证
        $notAuth = in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE'))) || in_array(ACTION_NAME, explode(',', C('NOT_AUTH_ACTION')));
        if (C('USER_AUTH_ON') && !$notAuth) {
            //RBAC认证,检查是否有权限
            $rbac = new \Org\Util\Rbac();
            if (!$rbac->AccessDecision()) {
                $this->error("您没有权限操作...");
            } else {
            }
        }

    }


}