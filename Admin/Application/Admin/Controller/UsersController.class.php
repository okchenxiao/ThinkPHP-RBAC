<?php
/**
 * Created by Xiao.
 * Date: 2017/5/17
 * email: via_chen@126.com
 */

namespace Admin\Controller;

class UsersController extends BaseController
{
    /**
     * @var \Admin\Model\UsersModel  模型对象
     */
    private $_model;

    public function _initialize()
    {
        $this->_model=D('Users');
    }

    /**
     * 登录页面
     */
    public function login()
    {
        C('LAYOUT_ON',false);//不要模板
        $this->display();
    }

    //ajax登录
    public function ajax_login()
    {
        if(IS_AJAX){
            $data=I('post.');//接收数据
            if($data['username']==''||$data['pwd']==''){
                return $this->ajaxReturn(0);
            }
            if ($this->_model->checkPwd($data)) {
                return $this->ajaxReturn(U('Index/index','','html',true));
            }
        }
        return $this->ajaxReturn(0);
    }

    //注销
    public function logout()
    {
        session('User',null);
        return $this->redirect('/Users/login');
    }

    public function add_user()
    {
        if(IS_POST){
            if ($this->_model->create('','add')===false) {
                session('alert_msg',$this->_model->getError());
                return $this->redirect('/Users/add_user');
            }
            if($this->_model->add_user()===false){
                session('alert_msg',$this->_model->getError());
                return $this->redirect('/Users/add_user');
            }
            session('alert_msg','添加成功!');
            return $this->redirect('/Users/add_user');
        }
        $this->display('add');
    }
}