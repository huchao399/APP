<?php
/**
 * Created by PhpStorm.
 * User: huchao
 * Date: 2017/11/29
 * Time: 15:54
 */

namespace Admin\Controller;

use Think\Page;

class HighLevelController extends BaseController {

    /**
     * 列表
     */
    public function lists() {
        $keyword = I('keyword', '', 'trim');                        //过滤开头空格
        if ($keyword) {                                             //如果有搜索关键字则按关键字模糊查询
            $map['high_name'] = array('like', "%$keyword%");        //模糊查询
            $this->assign('keyword', $keyword);              //输出数据
        }
        $high_level = M('high_level');
        $count = $high_level->count();                              //high_level表中的数据总量
        $row = 10;                                                  //每页显示条数
        $Page = new Page($count, $row);
        $show = $Page->show();
        $datalists = $high_level->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('page', $show);
        $title = '高级分类管理';
        $this->assign('title', $title);
        $this->assign('datalists', $datalists);
        $this->display();
    }

    /**
     * 新增或编辑
     */
    public function add() {
        $high_level = M('high_level');
        if (IS_POST) {
            $data = I('post.');
            if ($data['id']) {      //id存在就是编辑
                $res = $high_level->where(array('id' => $data['id']))->save($data);
            } else {        //id不存在就是新增
                $res = $high_level->add($data);
            }
            if ($res) {
                $this->success('操作成功', U('lists'));
            } else {
                $this->error('操作失败');
            }
        } else {
            /**id存在是编辑的情况，需要获取高级分类**/
            $map['id'] = $id = I('id', 0, 'int');
            if ($id) {
                $high_level = $high_level->where($map)->find();
                $this->assign('data', $high_level);
            }
            $this->display();
        }

    }


    /**
     * 单选删除
     */
    public function delete() {
        $map['id'] = $high_id = I('id', 0, 'int');
        /**查找该高级分类下是否有中级分类，如果有则不能删除**/
        $middle_level = M('middle_level')->where(array('high_id' => $high_id))->select();
        if ($middle_level) {
            $message = '请先删除该高级分类下的中级分类';
            $this->ajaxReturn($message);
        }
        $res = M('high_level')->where($map)->delete();
        if ($res) {
            $message = '删除成功';
        } else {
            $message = '删除失败';
        }
        $this->ajaxReturn($message);
    }

    /**
     * 全选删除
     */
    public function delAll() {
        $ids = I('ids', 0);
        /**判断高级分类下是否有中级分类**/
        $where['high_id'] = array('in', $ids);
        $middle_level = M('middle_level')->where($where)->select();
        if ($middle_level) {
            $message = '请先删除该高级分类下的中级分类';
            $this->ajaxReturn($message);
        }
        $map['id'] = array('in', $ids);
        if (M('high_level')->where($map)->delete()) {
            $message = '删除成功';
        } else {
            $message = '删除失败';
        }
        $this->ajaxReturn($message);
    }
}