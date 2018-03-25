<?php
/**
 * Created by PhpStorm.
 * User: 46284
 * Date: 2017/12/3
 * Time: 20:35
 */

namespace Admin\Controller;


use Think\Page;

class ElementaryLevelController extends BaseController {
    /**
     * 列表
     */
    public function lists() {
        $keyword = I('keyword', '', 'trim');
        if ($keyword) {
            $map['elementary_name'] = array('like', "%$keyword%");
            $this->assign('keyword', $keyword);
        }
        $elementary_level = M('elementary_level');
        $count = $elementary_level->where($map)->count();
        $row = 10;
        $Page = new Page($count, $row);
        $show = $Page->show();
        $datalists = $elementary_level->where($map)->order('sort desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('page', $show);
        $title = '初级分类管理';
        $this->assign('title', $title);
        $this->assign('datalists', $datalists);
        $this->display();
    }

    public function add() {
        $high_level = M('high_level');
        $elementary_level = M('elementary_level');
        if (IS_POST) {
            $data = I('post.');
            $res = $elementary_level->add($data);
            if ($res) {
                $this->success('添加成功', U('lists'));
            } else {
                $this->error('添加失败');
            }
        } else {
            $high = $high_level->select();
            $this->assign('high_level', $high);
            $this->display();
        }
    }

    public function edit() {
        $high_level = M('high_level');
        $middle_level = M('middle_level');
        $elementary_level = M('elementary_level');
        if (IS_POST) {
            $data = I('post.');
            $res = $elementary_level->where(array('id' => $data['id']))->save($data);
            if ($res) {
                $this->success('修改成功', U('lists'));
            } else {
                $this->error('修改失败');
            }
        } else {
            $map['id'] = I('id', '0', 'int');
            $elementary = $elementary_level->where($map)->find();
            $this->assign('data', $elementary);
            $middle = $middle_level->select();
            $this->assign('middle_level', $middle);
            $high = $high_level->select();
            $high_id = $middle_level->where(array('id' => $elementary['middle_id']))->getField('high_id');
            $this->assign('high_id', $high_id);
            $this->assign('high_level', $high);
            $this->display();
        }
    }

    /**
     * 获取中级分类信息
     */
    public function get_middle_info() {
        $map['high_id'] = I('high_id', 0, 'int');
        $middle = M('middle_level')->where($map)->field('id,middle_name')->select();
        $option = '';
        foreach ($middle as $vo) {
            $option .= '<option value=' . $vo['id'] . '>' . $vo['middle_name'] . '</option>';
        }
        echo $option;
    }
}