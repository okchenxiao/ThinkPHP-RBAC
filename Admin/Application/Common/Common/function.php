<?php
/**
 * Created by Xiao.
 * Date: 2017/5/17
 * email: via_chen@126.com
 */

/**
 * md5加盐加密统一使用
 */
function md5Salt($password,$salt)
{
    return md5(md5($password).$salt);
}