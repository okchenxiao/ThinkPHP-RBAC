<?php
/**
 * Created by Xiao.
 * Date: 2017/5/17
 * email: via_chen@126.com
 */

/**
 * md5���μ���ͳһʹ��
 */
function md5Salt($password,$salt)
{
    return md5(md5($password).$salt);
}