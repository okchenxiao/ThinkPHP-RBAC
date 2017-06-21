<?php
/**
 * Created by Xiao.
 * Date: 2017/5/31
 * email: via_chen@126.com
 */

namespace Admin\Controller;

class AuthoritiesController extends BaseController
{
    /**
     * @var \Admin\Model\AuthoritiesModel  模型对象
     */
    private $_model;

    public function _initialize()
    {
        $this->_model=D('Authorities');
    }

    public function index()
    {
        $lists=$this->_model->lists();
        $this->assign('lists',$lists);
        $this->display();
    }

    //ajax删除权限 包括子权限
    public function ajax_delete()
    {
        if(IS_AJAX && isset($_POST['id'])){
            if ($this->_model->delete_all($_POST['id'])!==false) {
                return $this->ajaxReturn(1);
            }
            return $this->ajaxReturn(0);
        }
        return $this->redirect('/Index/index');
    }

    //ajax权限移动操作,更新数据
    public function ajax_move()
    {
        if(IS_AJAX && isset($_POST['id']) && isset($_POST['pid'])){
            $data=array('id'=>$_POST['id'],'parent_id'=>$_POST['pid'],'modified'=>dateNow());
            if ($this->_model->save($data)!==false) {
                return $this->ajaxReturn(1);
            }
            return $this->ajaxReturn(0);
        }
        return $this->redirect('/Index/index');
    }
}