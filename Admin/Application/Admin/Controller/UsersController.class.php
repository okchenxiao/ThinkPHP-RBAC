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
        $this->display();
    }

    public function ajax_login()
    {
        if(IS_AJAX){
            $data=I('post.');//接收数据
            if($data['username']==''||$data['pwd']==''){
                return false;
            }
            if ($this->_model->checkPwd($data)) {
                return $this->ajaxReturn(U('Index/index','','html',true));
            }
        }
        return false;
    }
}