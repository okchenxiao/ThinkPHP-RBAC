<?php
/**
 * Created by Xiao.
 * Date: 2017/5/17
 * email: via_chen@126.com
 */

namespace Admin\Model;
use Think\Model;

class UsersModel extends Model
{
    protected $patchValidate = true;//������֤


    public function checkPwd($data)
    {
        $adminMsg=$this->where(array('username'=>$data['username']))->find();
        if($adminMsg==false){
            return false;
        }
        //���ܼ���
        $post_password=md5Salt($data['pwd'],$adminMsg['salt']);
        if($post_password!=$adminMsg['password']){
            return false;
        }
        //��õ�¼ip
        $userIP=get_client_ip(1);
        //�����û���¼IP������¼ʱ��
        $updateData=array('id'=>$adminMsg['id'],'last_ip'=>$userIP,'modified'=>date('Y-m-d H:i:s'));
        if ($this->save($updateData)===false) {
            return false;
        }
        if($data['is_remember']==1){
            //��¼cookie  1���¹���ʱ��
            $remember['id']=$adminMsg['id'];
            $remember['token']=$this->newToken();
            cookie('User',$remember,60*60*24*30);
            //�����µ�token�����ݿ�
            $this->save($remember);
        }
        //��¼session
        session('User',array('id'=>$adminMsg['id'],'role_id'=>$adminMsg['role_id'],'real_name'=>$adminMsg['real_name'],'username'=>$adminMsg['username']));
        //$this->_permissionPath();//��¼Ȩ��·��

        return true;
    }
}