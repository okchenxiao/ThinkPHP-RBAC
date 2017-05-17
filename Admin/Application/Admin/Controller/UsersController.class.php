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
     * @var \Admin\Model\UsersModel  ģ�Ͷ���
     */
    private $_model;

    public function _initialize()
    {
        $this->_model=D('Users');
    }

    /**
     * ��¼ҳ��
     */
    public function login()
    {
        $this->display();
    }

    public function ajax_login()
    {
        if(IS_AJAX){
            $data=I('post.');//��������
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