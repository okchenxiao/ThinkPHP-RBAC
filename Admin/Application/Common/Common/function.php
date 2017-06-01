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

/**
 * 随机字符串 比如用作生成toke等
 * @param $len
 * @return string
 */
function randString($len)
{
    return \Org\Util\String::randString($len);
}

/**
 * 引入js  支持批量
 * @param $jss  /layer/layer.js
 * @return string
 */
function includeJs($jss)
{
    if(is_array($jss)){
        $data='';
        foreach($jss as $key=>$js){
            $data.= '<script type="text/javascript" src="'.C('TMPL_PARSE_STRING.__JS__').'/'.$js.'.js"></script>';
        }
        return $data;
    }else{
        return '<script type="text/javascript" src="'.C('TMPL_PARSE_STRING.__JS__').'/'.$jss.'.js"></script>';
    }
}

/**
 * 批量引入css
 * @param $css
 * @return string
 */
function includeCss($css)
{
    if(is_array($css)){
        $data='';
        foreach($css as $key=>$cs){
            $data.= '<link rel="stylesheet" type="text/css" href="'.C('TMPL_PARSE_STRING.__CSS__').'/'.$cs.'.css" />';
        }
        return $data;
    }else{
        return '<link rel="stylesheet" type="text/css" href="'.C('TMPL_PARSE_STRING.__CSS__').'/'.$css.'.css" />';
    }
}

/** 当前时间的日期格式,
 * @param string $style
 * @return bool|string
 */
function dateNow($style='Y-m-d H:i:s')
{
    return date($style,NOW_TIME);
}

function alert_msg()
{
    if(session('?alert_msg')){
        $info='';
        $msg=session('alert_msg');
        if(is_array($msg)){
            $info=implode(' !　',$msg);
        }else{
            $info=$msg;
        }
        echo '<div class="alert alert-info">

    <button class="close" data-dismiss="alert"></button>

    '.$info.'

</div>';
        session('alert_msg',null);
    }
}