<?php /*a:1:{s:61:"D:\www\India-2\application\lmgadmin\view\contactus\index.html";i:1586274139;}*/ ?>
<script type="text/javascript" charset="utf-8" src="/lmgadmin/baidu/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/lmgadmin/baidu/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/lmgadmin/baidu/lang/zh-cn/zh-cn.js"></script>
<div class="public-backdrop-white">

    <!--  内容  -->
    <div class="public-content">

        <form class="layui-form" action="<?php echo url('edit'); ?>">

            <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-block">
                    <input type="text" name="username" value="<?php echo htmlentities($data['username']); ?>" autocomplete="off" placeholder="请输入标题" class="layui-input">
                </div>
            </div>

            <script id="editor"  name="content" style="width: 99%;height: 500px" type="text/plain" ><?php echo $data['content']; ?></script>

            <div class="layui-form-item public-center public-marign-top-15">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="submit">立即提交</button>
            </div>
        </form>

    </div>

</div>

<script>

    layui.use(['form', 'layer'], function() {
        var layer = layui.layer,
            form = layui.form;

        let ue = UE.getEditor('editor',{
            scaleEnabled:true,
            autoFloatEnabled:false
        });

        //监听提交
        form.on('submit(submit)', function(data){
            var action = data.form.action;
            var field = data.field;
            $.Public.post({
                type:'post',
                url: action,
                data: field,
                success: function() {
                },
            });
            return false;
        });

    })

</script>