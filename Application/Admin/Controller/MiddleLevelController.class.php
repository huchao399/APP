<?php
/**
 * Created by PhpStorm.
 * User: huchao
 * Date: 2017/11/30
 * Time: 15:20
 */

namespace Admin\Controller;

use Think\Page;

class MiddleLevelController extends BaseController {

    /**
     * 列表
     */
    public function lists() {
        $keyword = I('keyword', '', 'trim');
        if ($keyword) {
            $map['middle_name'] = array('like', "%$keyword%");      //模糊查询
            $this->assign('keyword', $keyword);
        }
        $count = M('MiddleLevel')->where($map)->count();            //获取数据
        $row = 10;                                                  //每页显示10条
        $Page = new Page($count, $row);                             //实例化分页类
        $show = $Page->show();                                      //调用show方法
        /**获取中级分类数据**/
        $datalists = D('MiddleLevel')->relation(true)->where($map)->order('high_id desc, sort desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        /**赋值输出**/
        $this->assign('page', $show);                           //赋值分页输出
        $title = '中级分类管理';
        $this->assign('title', $title);
        $this->assign('datalists', $datalists);
        $this->display();
    }

    /**
     *新增或编辑
     */
    public function add() {
        $high_level = M('high_level');
        $middle_level = M('middle_level');
        if (IS_POST) {
            $data = I('post.');
            if ($data['id']) {
                $res = $middle_level->where(array('id' => $data['id']))->save($data);
            } else {
                $res = $middle_level->add($data);
            }
            if ($res) {
                $this->success('操作成功', U('lists'));
            } else {
                $this->error('操作失败');
            }
        } else {
            $map['id'] = $id = I('id', 0, 'int');
            if ($id) {
                $middle_level = $middle_level->where($map)->find();
                $this->assign('data', $middle_level);
            }
            $high_level = $high_level->select();
            $this->assign('high_level', $high_level);
            $this->display();
        }
    }

    /**
     * 单选删除
     */
    public function delete() {
        $map['id'] = $middle_id = I('id', 0, 'int');
        /**查找该中级分类下是否有低级分类，如果有则不能删除**/
        $elementary_level = M('elementary_level')->where(array('middle_id' => $middle_id))->select();
        if ($elementary_level) {
            $message = '请先删除该中级分类下的低级分类';
            $this->ajaxReturn($message);
        }
        $res = M('middle_level')->where($map)->delete();
        if ($res) {
            $message = '删除成功';
        } else {
            $message = '删除失败';
        }
        $this->ajaxReturn($message);
    }

    /**
     * 全选选删除
     */
    public function delAll() {
        $ids = I('ids', 0);
        /**判断该中级分类下是否有低级分类**/
        $where['middle_id'] = array('in', $ids);
        $datalists = M('elementary_level')->where($where)->select();
        if ($datalists) {
            $message = '请先删除该中级分类下的低级分类';
            $this->ajaxReturn($message);
        }
        $map['id'] = array('in', $ids);
        $res = M('middle_level')->where($map)->delete();
        if ($res) {
            $message = '删除成功';
        } else {
            $message = '删除失败';
        }
        $this->ajaxReturn($message);
    }
}