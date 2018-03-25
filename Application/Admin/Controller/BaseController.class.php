<?php
/**
 * Created by PhpStorm.
 * User: huchao
 * Date: 2017/11/29
 * Time: 15:08
 */

namespace Admin\Controller;


use Think\Controller;

class BaseController extends Controller {
    public function _initialize() {
        $admin_id = session('admin_id');
        $admin_username = session('admin_username');
        if (!isset($admin_id) || !isset($admin_username)) {
            $this->redirect('Admin/Public/login');
        }
    }
}