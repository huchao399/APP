<?php

namespace Admin\Controller;


class IndexController extends BaseController {
    public function index() {
        $this->redirect('HighLevel/lists');
    }

    /**
     * 修改密码功能
     */
    public function changePassword() {
        if (IS_POST) {
            $old_password = I('old_password', '', 'md5');
            $new_password = I('new_password', '', 'md5');
            $map['id'] = session('admin_id');
            $admin = M('admin')->where($map)->find();
            if ($old_password == $admin['password']) {
                $admin = M('admin')->where($map)->setField('password', $new_password);
                if ($admin !== false) {
                    $res['status'] = 1;
                    $res['message'] = '密码修改成功！';
                    $this->ajaxReturn($res);
                } else {
                    $res['status'] = 0;
                    $res['message'] = '密码修改失败！';
                    $this->ajaxReturn($res);
                }
            } else {
                $res['status'] = 0;
                $res['message'] = '原始密码错误！';
                $this->ajaxReturn($res);
            }
        } else {
            $this->display();
        }
    }
}