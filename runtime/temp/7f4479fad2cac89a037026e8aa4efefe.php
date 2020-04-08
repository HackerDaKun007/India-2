<?php /*a:2:{s:57:"D:\www\India-2\application\lmgadmin\view\index\index.html";i:1586238373;s:59:"D:\www\India-2\application\lmgadmin\view\public\header.html";i:1586238373;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>后台管理系统 - admin</title>
    <link rel="stylesheet" type="text/css" href="/lmgadmin/layui/css/layui.css" />
<!--<link rel="stylesheet" type="text/css" href="/public/iconfont/iconfont.css" />-->
<script src="/public/js/jquery.js"></script>
<script src="/lmgadmin/layui/layui.js"></script>
<script src="/lmgadmin/public/shared.js"></script>
<link rel="stylesheet" type="text/css" href="/lmgadmin/public/public.css" />


    <link rel="stylesheet" type="text/css" href="/lmgadmin/public/index.css" />
</head>
<body class="layui-layout-body">

<!--屏幕小于992px-->
<div class="backdrop-992"></div>

<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">后台管理系统</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item column-right"><a href="javascript:;">
                <i class="layui-icon layui-icon-spread-left" ></i>
            </a></li>
            <li class="layui-nav-item refresh"><a href="javascript:;">
                <i class="layui-icon layui-icon-refresh-3 " ></i>
            </a></li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item"><a href="javascript:;">
                <i class="layui-icon layui-icon-notice " ></i>
                <span class="layui-badge-dot"></span>
            </a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="/Upload/<?php echo htmlentities($AdminArray['img']); ?>" class="layui-nav-img">
                    <span class="layui-side-user"><?php echo htmlentities($AdminArray['username']); ?></span>
                </a>
                <dl class="layui-nav-child public-child">
                    <dd><a href="javascript:;" class="index-personal">基本资料</a></dd>
                    <dd><a href="javascript:;" class="index-personal">安全设置</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item logout"><a href="javascript:;">
                <i class="layui-icon layui-icon-logout" ></i>
            </a></li>

        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->

            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <?php foreach($column as $k => $v): if($v['whether'] == 1): if(!empty($v['grade2']) &&  $v['grade2'][0]['whether'] == 1): ?>

                            <li class="layui-nav-item">
                                <a href="javascript:;"><?php echo htmlentities($v['username']); ?></a>
                                <dl class="layui-nav-child">
                                    <?php foreach($v['grade2'] as $ve): if($ve['whether'] == 1): ?>
                                        <dd><a href="javascript:;" class="index-column-url" url="/<?php echo htmlentities($ve['url']); ?>.html" title="<?php echo htmlentities($v['username']); ?>"><?php echo htmlentities($ve['username']); ?></a></dd>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </dl>
                            </li>
                        <?php else: ?>
                            <li class="layui-nav-item ">
                                <a class="index-column-url" href="javascript:;" url="/<?php echo htmlentities($v['url']); ?>.html" title="<?php echo htmlentities($v['username']); ?>"><?php echo htmlentities($v['username']); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>



            </ul>

        </div>
    </div>


<!--   <div class="layui-body-back"></div> -->
    <div class="layui-body">
        <!-- 内容主体区域 -->

    </div>

</div>
<script type="application/json" id="personal"><?php echo $personal; ?></script>
<script src="/lmgadmin/js/index.js"></script>

</body>
</html>