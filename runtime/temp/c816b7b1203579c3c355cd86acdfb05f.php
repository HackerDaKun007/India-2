<?php /*a:1:{s:68:"/Volumes/dakun/www/India-2/application/lmgadmin/view/role/index.html";i:1585486343;}*/ ?>
<style>
    .role-checkbox {

    }
    .role-checkbox-child {
        padding-left: 15px;
    }
</style>
<div class="public-backdrop-white">

    <!--  搜索  -->
    <div class="public-search">
        <form class="layui-form layui-form-pane">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">角色名</label>
                    <div class="layui-input-inline">
                        <input type="text" name="useranme"  placeholder="请输入角色名" autocomplete="off" class="layui-input">
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

    </div>

</div>

<script type="application/json" id="PowerShow"><?php echo $PowerShow; ?></script>

<script src="/lmgadmin/js/role.js"></script>