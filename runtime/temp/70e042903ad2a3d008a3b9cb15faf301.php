<?php /*a:1:{s:75:"/Volumes/dakun/www/India-2/application/lmgadmin/view/adminrecord/index.html";i:1585486343;}*/ ?>

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
                    <button class="layui-btn layuiadmin-btn-useradmin" lay-submit="" lay-filter="search">
                        <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!--  内容   -->
    <div class="public-content">

        <div class="public-content-table">
            <table class="layui-hide" id="content" lay-filter="content"></table>
        </div>

        <script type="text/html" id="barDemo">
            <a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
        </script>

        <script type="text/html" id="recordTime">
            {{ $.Public.turnTime(d.record_time) }}
        </script>

    </div>

</div>


<script src="/lmgadmin/js/adminrecord.js"></script>