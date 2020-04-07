<?php /*a:1:{s:69:"/Volumes/dakun/www/India-2/application/lmgadmin/view/login/index.html";i:1585818722;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="renderer" content="webkit">
    <title>登陆管理系统</title>
    <link rel="stylesheet" type="text/css" href="/lmgadmin/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/public/iconfont/iconfont.css" />
    <script src="/public/js/jquery.js"></script>
    <script src="/lmgadmin/public/shared.js"></script>
    <script src="/lmgadmin/layui/layui.js"></script>
    <link rel="stylesheet" type="text/css" href="/lmgadmin/public/public.css" />


    <link rel="stylesheet" href="/lmgadmin/public/login.css" type="text/css" />
</head>
<body>
<!-- 背景图片 -->
<div class="login-back">
    <img src="/lmgadmin/public/new_1.jpg" draggable="false" />
</div>
<div class="coutent">
    <!--标题-->
    <div class="coutent-title">登陆管理系统</div>
    <form class="layui-form" action="<?php echo url('index'); ?>">
        <div class="coutent-input float-no">
            <label class="coutent-input-label"><i class="layui-icon layui-icon-username"></i></label>
            <input name="username" type="text" lay-verify="username" class="coutent-input-t" value="" placeholder="请输入账号" />
        </div>
        <div class="coutent-input float-no">
            <label class="coutent-input-label"><i class="layui-icon layui-icon-password"></i></label>
            <input name="password" class="coutent-input-t" lay-verify="password" type="password" value="" placeholder="请输入账号" />
        </div>
        <div class="coutent-input-yzm float-no">
            <div class="coutent-input ">
                <label class="coutent-input-label"><i class="layui-icon layui-icon-vercode"></i></label>
                <input name="yzm" class="coutent-input-t" autocomplete="off" lay-verify="yzm" type="text" value="" placeholder="验证码" />
            </div>
            <img src="<?php echo url('yzm'); ?>" class="login-yzm">
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block login-land">
                <input type="checkbox" value="1" name="land" lay-skin="primary" title="七天内免登陆" >
            </div>
        </div>
        <div class="coutent-submit float-no">
            <button type="submit" class="layui-btn float-no"  lay-submit="" lay-filter="submit">登陆</button>
        </div>
    </form>
</div>

</body>
</html>


<script type="text/javascript" src="/lmgadmin/public/login.js"></script>