<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $this->assign("mainurl", U('Admin/Main/index'));
        $this->display();
    }

    public function logincheck()
    {

        if (IS_POST) {
            $code = I('param.verifycode');
            $verify = new \Think\Verify();
            if (!$verify->check($code)) {   //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                // $this->error('验证码错误', U('Admin/Index/index'));
                //  return json_encode(array('info' => '验证码错误'));
                $data = array('info' => '验证码错误');
                $this->ajaxReturn($data, 'JSON');
            } else {
                $result = Get_user_login(I('param.username'), I('param.password'));
                if ($result == "SUCC") {
                    $this->success('SUCC', U('Admin/Main/index'));
                } else {
                    $data = array('info' => '用户名或密码错误');
                    $this->ajaxReturn($data, 'JSON');
                }
            }
        }

    }

    /**
     *
     * 验证码生成
     */
    public function verify_c()
    {
        $Verify = new \Think\Verify();
        $Verify->fontSize = 24;
        $Verify->length = 4;
        $Verify->useNoise = true;
        $Verify->codeSet = '0123456789';
        $Verify->imageW = 280;
        $Verify->imageH = 40;
        $Verify->entry();
    }

    public function verify_check()
    {

        $code = I('param.verify');
        $verify = new \Think\Verify();
        if ($verify->check($code)) {
            echo "true";
        } else {
            echo "false";
        }


    }

}