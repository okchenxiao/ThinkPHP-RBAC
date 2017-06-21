<?php
/**
 * Created by Xiao.
 * Date: 2017/6/8
 * email: via_chen@126.com
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;
class BaseModel extends Model
{
    /** 公共分页工具
     * @param mixed $model  模型对象
     * @param string $order 排序
     * @param null $condition where条件
     * @return array
     */
    public function page($model,$order='id desc',$condition=null)
    {
        $obj=D($model);
        $count=$obj->count();
        $page=new Page($count,C('PAGE.SIZE'));
        $page->setConfig('theme',C('PAGE.THEME'));
        $page_html=$page->show();//数据分页
        $all=$obj->order($order)->where($condition)->limit($page->firstRow,$page->listRows)->select();
        return array('datas'=>$all,'pages'=>$page_html);
    }
}