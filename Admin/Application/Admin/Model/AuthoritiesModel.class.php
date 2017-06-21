<?php
/**
 * Created by Xiao.
 * Date: 2017/6/8
 * email: via_chen@126.com
 */

namespace Admin\Model;


use Think\Model;
class AuthoritiesModel extends BaseModel
{
    public function lists()
    {
        $all=$this->where('parent_id = 0')->select();
        $lists='[';//拼装为需要的数组
        foreach($all as $i=>$val){
            $children=$this->get_child($val['id']);
            $lists.='{id:"'.$val['id'].'",name:"'.$val['auth_name'].'"';
            if(!empty($children)){
                $lists.=',children:['.$children.']';
            }
            $lists.='},';
        }
        $lists.=']';
        return $lists;
    }

    //获得子权限
    public function get_child($pid,$need='string')
    {
        $children=$this->where(array('parent_id'=>$pid))->select();
        $data='';
        $data_arr='';//只要id的
        if(!empty($children)){
            foreach($children as $i=>$val){
                $grand_child=$this->get_child($val['id'],$need);//递归寻找子权限
                $data.='{id:"'.$val['id'].'",name:"'.$val['auth_name'].'"';
                if($grand_child!=''){
                    $data.=',children:['.$grand_child.']';
                    $data_arr.=$grand_child;
                }
                $data.='},';
                $data_arr.=$val['id'].',';
            }
        }
        if($need=='string'){
            return $data;
        }else{
            return $data_arr;
        }
    }

    //删除自己及子权限
    public function delete_all($id)
    {
        $ids=$this->get_child($id,'array');
        $ids.=$id;
        return $this->delete($ids);
    }
}