<?php
/**
 * Created by PhpStorm.
 * User: 46284
 * Date: 2017/11/26
 * Time: 00:29
 */

namespace Admin\Controller;

use Think\Controller;
use Think\Verify;

class PublicController extends Controller {

    /**
     * 登录方法
     */
    public function login() {
        $this->display();
    }

    /**
     * 生成验证码
     */
    public function verify() {
        $config = array(
            'fontSize' => 15,         //验证码字体大小
            'length' => 4,            //验证码长度
            'useNoise' => false,      //关闭验证码杂点
            'imageW' => 108,          //图片宽度
            'imageH' => 42,           //图片高度
            'codeSet' => '0123456789',//随机产生0-9中的数字
            'useCurve' => false,
        );
        //实例化类，并调用生成验证码的方法
        $Verify = new Verify($config);
        $Verify->entry();
    }

    /**
     * 检验登录信息
     */
    public function checkLogin() {
        /**检测验证码是否正确**/
        $code = I('code');
        $verify = $this->checkCode($code);
        if (!$verify) {
            $res['status'] = 0;
            $res['message'] = '验证码错误';
            $this->ajaxReturn($res);
        }

        /**检测用户名密码是否正确**/
        $username = I("username", "", "trim");
        $password = I("password", "", "md5");
        $return = $this->checkPassword($username, $password);
        if (!$return) {
            $res['status'] = 0;
            $res['message'] = '用户名或密码错误';
            $this->ajaxReturn($res);
        } else {
            $data = array(
                'loginip' => get_client_ip(),
                'logintime' => date('Y-m-d H:i:s'),
            );
            M('admin')->save($data);
            session('admin_id', $return['id']);
            session('admin_username', $return['username']);
            $res['status'] = 1;
            $res['message'] = '登录成功！';
            $this->ajaxReturn($res);
        }

    }

    /**
     * 检测验证码是否正确
     * @param $code : 输入的验证码
     * @return bool : 返回值
     */
    public function checkCode($code) {
        $Verify = new Verify();
        return $Verify->check($code);
    }

    /**
     * 检测用户名密码是否匹配
     * @param $username
     * @param $password
     * @return bool|mixed
     */
    public function checkPassword($username, $password) {
        $map['username'] = $username;
        $admin = M('admin')->where($map)->find();
        if ($password == $admin['password']) {
            return $admin;
        } else {
            return false;
        }
    }

    public function logout() {
        session('admin_id', null);
        session('admin_username', null);
        $this->redirect('login');
    }

}