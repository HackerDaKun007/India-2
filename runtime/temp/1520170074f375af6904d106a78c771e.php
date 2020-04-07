<?php /*a:1:{s:72:"/Volumes/dakun/www/India-2/application/lmgadmin/view/flowdate/index.html";i:1586178174;}*/ ?>

<div class="public-backdrop-white">

    <!--  搜索  -->
    <div class="public-search">
        <form class="layui-form layui-form-pane">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">选择日期</label>
                    <div class="layui-input-inline">
                        <input type="text" name="date" id="date"  placeholder="请输入选择日期" autocomplete="off" class="layui-input">
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
            <a href="javascript:;" class="layui-btn layui-btn-xs " lay-event="edit">查看</a>
        </script>

        <script type="text/html" id="dateId">
            {{ $.Public.turnTime(d.date,false) }}
        </script>
    </div>

</div>

<!--<script src="/lmgadmin/js/favorite.js"></script>-->
<script>
    layui.use(['form', 'layer', 'table','laydate'], function() {
        var layer = layui.layer,
            form = layui.form,
            laydate = layui.laydate,
            table = layui.table;

        //日期范围
        laydate.render({
            elem: '#date'
        });

        //提交地址
        var public_url = $.Public.url + 'flowdate/';

        var tableIns = table.render({
            elem: '#content'
            ,where:{request:200}
            , url: public_url + 'index.html'
            , cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
            , cols: [[
                {field: 'flowdate_id', width: 100, title: 'ID', sort: true}
                , {field: 'date', width: '', minWidth:180, title: '日期', toolbar: '#dateId'}
                , {field: 'pv', width: 130, title: 'pv流量'}
                , {fixed: 'right', title: '操作', toolbar: '#barDemo', width: 150}
            ]]
            , limit: 10
            , page: true
        });

        //搜索
        form.on('submit(search)',function(data){
            var field = data.field;
            field.request = 200;
            tableIns.reload({
                where:field,
                page: {
                    curr: 1 //重新从第 1 页开始
                }
            });
            return false;
        });

        //查看
        table.on('tool(content)',function(obj) {
            let data = obj.data;
            if (obj.event == 'edit') {
                let add_url = public_url + 'pv.html';
                $.Public.yzPost({
                    type: 'post',
                    url: add_url,
                    data: '',
                    success: function () {
                        layer.open({
                            title: '查看pv'
                            , type: 1
                            , area: ['1300px', '600px']
                            , closeBtn: 1
                            , shade: 0.3
                            , id: 'LA_layer'
                            , moveType: 1
                            , zIndex:50
                            , content: '<div class="public-backdrop-white">\n' +
                                '    <div class="public-search">\n' +
                                '        <form class="layui-form layui-form-pane">\n' +
                                '            <div class="layui-form-item">\n' +
                                '                <div class="layui-inline">\n' +
                                '                    <label class="layui-form-label">ip</label>\n' +
                                '                    <div class="layui-input-inline">\n' +
                                '                        <input type="text" name="ip"  placeholder="请输入ip" autocomplete="off" class="layui-input">\n' +
                                '                    </div>\n' +
                                '                </div>\n' +
                                '                <div class="layui-inline">\n' +
                                '                    <label class="layui-form-label">ip地区</label>\n' +
                                '                    <div class="layui-input-inline">\n' +
                                '                        <input type="text" name="ipadder"  placeholder="请输入ip地区" autocomplete="off" class="layui-input">\n' +
                                '                    </div>\n' +
                                '                </div>\n' +
                                '                <div class="layui-inline">\n' +
                                '                    <button class="layui-btn layuiadmin-btn-useradmin" lay-submit="" lay-filter="pv-search">\n' +
                                '                        <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>\n' +
                                '                    </button>\n' +
                                '                </div>\n' +
                                '            </div>\n' +
                                '        </form>\n' +
                                '    </div>\n' +
                                '    <!--  内容   -->\n' +
                                '    <div class="public-content">\n' +
                                '        <div class="public-content-table">\n' +
                                '            <table class="layui-hide" id="pv-content" lay-filter="pv-content"></table>\n' +
                                '        </div>\n' +
                                '<script type="text/html" id="pv-dateId">\n'+
                                '            {{ $.Public.turnTime(d.addtime) }}\n'+
                                '        <\/script>\n'+
                                '    </div>\n'+
                                '\n'+
                                '</div>'
                        })
                        //提交地址
                        var tableIns = table.render({
                            elem: '#pv-content'
                            ,where:{request:200,flowdate_id:data.flowdate_id}
                            , url: public_url + 'pv.html'
                            , cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
                            , cols: [[
                                {field: 'pv_id', width: 100, title: 'ID', sort: true}
                                , {field: 'ip', width: 140, title: 'ip地址'}
                                , {field: 'ipadder', width: 220, title: 'ip地区'}
                                , {field: 'num', width: 100, title: '访问次数'}
                                , {field: 'url', width: '', title: '访问URL'}
                                , {field: 'addtime', width: 170, title: '日期', toolbar: '#pv-dateId'}
                            ]]
                            , limit: 10
                            , page: true
                            ,method:'post'
                            ,headers:{addDate:2}
                        });

                        //搜索
                        form.on('submit(pv-search)',function(data){
                            var field = data.field;
                            field.request = 200;
                            field.flowdate_id = data.flowdate_id;
                            tableIns.reload({
                                where:field,
                                page: {
                                    curr: 1 //重新从第 1 页开始
                                }
                            });
                            return false;
                        });
                    }
                })
            }
        })


    })

</script>