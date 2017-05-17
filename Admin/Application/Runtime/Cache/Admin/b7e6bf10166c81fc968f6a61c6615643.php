<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://admin.aiyo.com/Public/css/bootstrap.css">
    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    <link rel="stylesheet" href="http://admin.aiyo.com/Public/css/bootstrap-theme.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="http://admin.aiyo.com/Public/js/jquery-1.11.2.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="http://admin.aiyo.com/Public/js/bootstrap.js"></script>

    <style>
        body{
            background: url("http://admin.aiyo.com/Public/img/bg.jpg");
            background-size: cover;
        }
        .to-login{
            width: 40%;
            border: 1px solid grey;
            border-radius: 30px;
            margin-left: 30%;
            margin-top: 10%;
            background-color: rgba(96,96,96,0.4);
        }
        .to-login form{
            margin-top: 40px;
            margin-left: 20px;
            font-weight: bold;
        }
        #showVerify{
            border-radius: 5px;
        }
        label{
            font-weight: bold;
            color: #01f2ff;
        }
        #info{
            display: none;
            color: red;text-align: center;
            font-size: 20px;font-weight: bold;
        }
    </style>

</head>
<body>

<div class="to-login">
    <center><h1 style="color: #99d3da">管理员登录</h1></center>
    <form onsubmit="return false;" class="form-horizontal" role="form" style="width: 85%">
        <p id="info"></p>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="name" placeholder="请输入您的账号"/>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">密　码</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="password" placeholder="请输入密码"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input name="remember" value="1" type="checkbox" id="remember"/> 记住这次登录信息
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <center>
                    <button type="button" id="login" style="margin-right: 50px" class="btn btn-lg btn-info">确 认 登 录</button>
                    <a href="#" class="btn btn-lg btn-success">注册</a>
                </center>
            </div>
        </div>
    </form>
</div>
<script>
    $('#login').click(function(){
        var data=$('form').serializeArray();
        var name;
        var pwd;
        var is_remember=0;//获得数据并去除空白字符
        $.each(data,function(i,v){
            switch (v.name){
                case 'name':
                    name = $.trim(v.value);
                    break;
                case 'password':
                    pwd = $.trim(v.value);
                    break;
                case 'remember':
                    is_remember = $.trim(v.value);
                    break;
            }
        });
        if(name==''||pwd==''||name=='undefined'||pwd=='undefined'){
            $('#info').css('display','block');
            $('#info').text('用户名或密码不能为空!');
            return false;
        }else{
            $('#info').css('display','none');
        }
        var url="<?php echo U('Users/ajax_login','','',true);?>";
        $.post(url,{username:name,pwd:pwd,is_remember:is_remember},function(res){

        },'json');
    });
</script>
</body>
</html>