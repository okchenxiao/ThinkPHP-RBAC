<?php
/**
 * Created by Xiao.
 * Date: 2017/5/17
 * email: via_chen@126.com
 */

namespace Admin\Model;
use Think\Model;
use Think\Page;
class UsersModel extends BaseModel
{
    //批量验证
    protected $patchValidate = true;

    //自动验证  用户名密码不能为空,,,用户名不能重复
    protected $_validate = array(
        array('real_name','require','请输入用户名！',0,'','add'), //添加时的验证
        array('email','require','请输入邮箱！',0,'','add'), //
    );

    //自动完成
    protected $_auto = array(
        array('salt','\Org\Util\String::randString','add','function'),//盐
        array('last_ip','get_client_ip','add','function'),//
        array('created','dateNow','add','function'),//
        array('modified','dateNow',3,'function'),//
        array('password','email','add','field'),//密码
        array('username','email','add','field'),//用户名
    );

    //检测登录密码
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
        if($data['is_remember']==1){//如果勾选则记录cookie
            //记录cookie  1个月过期时间
            $updateData['token']=randString(32);
            cookie('User',array('id'=>$adminMsg['id'],'token'=>$updateData['token']),60*60*24*30);
        }
        if ($this->save($updateData)===false) {
            return false;
        }
        //记录session
        session('User',array('id'=>$adminMsg['id'],'role_id'=>$adminMsg['role_id'],'real_name'=>$adminMsg['real_name'],'username'=>$adminMsg['username']));
        //$this->_permissionPath();//记录权限路径
        return true;
    }

    //获得对应的权限路径
    private function _permissionPath()
    {
        $adminMsg=session('loginMsg');
        $pathsData = M('AdminRole')->alias('ar')->field('p.id,path')->join('__ROLE_PERMISSION__ as rp using(`role_id`)')->join('__PERMISSION__ as p ON rp.`permission_id`=p.`id`')->where(['ar.admin_id' => $adminMsg['id']])->select();
        $paths=[];
        $permission_ids=[];
        foreach($pathsData as $path){
            $paths[]=$path['path'];
            $permission_ids[]=$path['id'];
        }
        session('paths',$paths);
        session('permission_ids',$permission_ids);
    }

    //密码加盐加密 添加用户
    public function add_user()
    {
        $this->data['password']=md5Salt($this->data['password'],$this->data['salt']);
        $res=$this->add();
        return $res;
    }

    //所有用户
    public function all_user()
    {
        $count=$this->count();
        $page=new Page($count,C('PAGE.SIZE'));
        $page->setConfig('theme',C('PAGE.THEME'));
        $page_html=$page->show();//数据分页
        $all=$this->order('modified desc')->limit($page->firstRow,$page->listRows)->select();
        return array('all'=>$all,'page'=>$page_html);
    }
}