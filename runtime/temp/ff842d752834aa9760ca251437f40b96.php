<?php /*a:1:{s:69:"/Volumes/dakun/www/India-2/application/lmgadmin/view/admin/index.html";i:1585486343;}*/ ?>
<style>
    .admin-img {
        width: 100%;
        height: 100px;
        text-align: center;
    }
    .admin-img img {
        width: 80px;
        height: 80px;
        border-radius: 100%;
        border:3px solid #a5a5a5;
        cursor:pointer;
        overflow: hidden;
    }

</style>
<div class="public-backdrop-white">

    <!--  搜索  -->
    <div class="public-search">
        <form class="layui-form layui-form-pane">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">用户名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="username"  placeholder="请输入用户名称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">姓名</label>
                    <div class="layui-input-inline">
                        <input type="text" name="user"  placeholder="请输入姓名" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">手机号</label>
                    <div class="layui-input-inline">
                        <input type="text" name="tei"  placeholder="请输入手机号" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <button class="layui-btn layuiadmin-btn-useradmin" lay-submit="" lay-filter="search">
                        <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!--  内容   -->
    <div class="public-content">
        <!--    添加等操作    -->
        <div class="public-column-bottom-10">
            <button class="layui-btn public-btn-sm add" >添加</button>
        </div>

        <div class="public-content-table">
            <table class="layui-hide" id="content" lay-filter="content"></table>
        </div>
        <script type="text/html" id="barDemo">
            <a href="javascript:;" class="layui-btn layui-btn-xs modify" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
            <a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
        </script>
        <script type="text/html" id="disable">
            {{# if(d.disable == 1){  }}
            <button type="button" class="layui-btn  layui-btn-xs " >启用</button>
            {{#  } else if(d.disable == 2) { }}
            <button type="button" class="layui-btn  layui-btn-xs layui-btn-disabled">禁用</button>
            {{#  } }}
        </script>
        <script type="text/html" id="img">
            <img src="{{ d.img }}" class="public-images-30 " />
        </script>

    </div>

</div>

<script type="application/json" id="role"><?php echo $role; ?></script>

<script src="/lmgadmin/js/admin.js"></script>