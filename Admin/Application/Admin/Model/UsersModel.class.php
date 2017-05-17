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
    protected $patchValidate = true;//批量验证


    public function checkPwd($data)
    {
        $adminMsg=$this->where(array('username'=>$data['username']))->find();
        if($adminMsg==false){
            return false;
        }
        //加密加盐
        $post_password=md5Salt($data['pwd'],$adminMsg['salt']);
        if($post_password!=$adminMsg['password']){
            return false;
        }
        //获得登录ip
        $userIP=get_client_ip(1);
        //更新用户登录IP和最后登录时间
        $updateData=array('id'=>$adminMsg['id'],'last_ip'=>$userIP,'modified'=>date('Y-m-d H:i:s'));
        if ($this->save($updateData)===false) {
            return false;
        }
        if($data['is_remember']==1){
            //记录cookie  1个月过期时间
            $remember['id']=$adminMsg['id'];
            $remember['token']=$this->newToken();
            cookie('User',$remember,60*60*24*30);
            //保存新的token到数据库
            $this->save($remember);
        }
        //记录session
        session('User',array('id'=>$adminMsg['id'],'role_id'=>$adminMsg['role_id'],'real_name'=>$adminMsg['real_name'],'username'=>$adminMsg['username']));
        //$this->_permissionPath();//记录权限路径

        return true;
    }
}