<?php
/**
 * Created by PhpStorm.
 * User: 46284
 * Date: 2017/12/30
 * Time: 20:57
 */

namespace Admin\Controller;


use Think\Page;

class DataListController extends BaseController {
    /**
     * 列表
     */
    public function lists() {
        $keyword = I('keyword', '', 'trim');
        if ($keyword) {
            $map['title'] = array('like', "%$keyword%");
            $this->assign('keyword', $keyword);
        }
        $low_level = M('datalist');
        $count = $low_level->where($map)->count();
        $row = 10;
        $Page = new Page($count, $row);
        $show = $Page->show();
        $datalists = $low_level->where($map)->order('sort desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('page', $show);
        $title = '数据管理';
        $this->assign('title', $title);
        $this->assign('datalists', $datalists);
        $this->display();
    }

    /**
     * 新增
     */
    public function add() {
        $low_level = M('datalist');
        if (IS_POST) {
            $data = I('post.');
            $res = $low_level->add($data);
            if ($res) {
                $this->success('操作成功', U('lists'));
            } else {
                $this->success('操作失败');
            }
        } else {
            $high_level = M('high_level')->select();
            $this->assign('high_level', $high_level);
            $this->display();
        }
    }

    /**
     * 获取中级分类
     */
    public function get_middle_info() {
        $map['high_id'] = I('high_id', 0, 'int');
        $middle_level = M('middle_level')->where($map)->field('id,middle_name')->select();
        $option = '';
        foreach ($middle_level as $vo) {
            $option .= '<option value=' . $vo['id'] . '>' . $vo['middle_name'] . '</option>';
        }
        echo $option;
    }

    /**
     * 获取初级分类
     */
    public function get_elementary_info() {
        $map['middle_id'] = I('middle_id', 0, 'int');
        $elementary_level = M('elementary_level')->where($map)->field('id,elementary_name')->select();
        $option = '';
        foreach ($elementary_level as $vo) {
            $option .= '<option value=' . $vo['id'] . '>' . $vo['elementary_name'] . '</option>';
        }
        echo $option;
    }
}