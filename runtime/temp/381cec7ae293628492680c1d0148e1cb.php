<?php /*a:1:{s:67:"/Volumes/dakun/www/India-2/application/lmgadmin/view/web/index.html";i:1586230214;}*/ ?>
<style>
    .logo , .ico{
        width: 100px;
        height: 100px;
        border-radius: 3px;
        overflow: hidden;
        border: 1px solid #e6e6e6;
    }
    img[src = ""] {
        opacity: 1;
    }
    img {
        cursor: pointer;
    }
    .ico {
        width: 50px;
        height: 50px;
    }
</style>

<div class="public-backdrop-white">

<!--  内容 -->
    <div class="public-content ">

        <form class="layui-form" action="<?php echo url('edit'); ?>">

            <div class="layui-form-item">
                <label class="layui-form-label">网站名称</label>
                <div class="layui-input-block">
                    <input type="text" value="<?php echo htmlentities($data['username']); ?>" name="username" autocomplete="off" placeholder="网站名称" class="layui-input" />
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">网站logo</label>
                <div class="layui-input-block">
                    <img src="/<?php echo htmlentities($data['logo']); ?>" class="logo" />
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">网站图标</label>
                <div class="layui-input-block">
                    <img src="/<?php echo htmlentities($data['ico']); ?>" class="ico" />
                </div>
            </div>

            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                <legend>seo设置</legend>
            </fieldset>
            <div class="layui-form-item">
                <label class="layui-form-label">seo</label>
                <div class="layui-input-block">
                    <input type="text" name="seo" value="<?php echo htmlentities($data['seo']); ?>" autocomplete="off" placeholder="网站名称" class="layui-input" />
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">seo介绍</label>
                <div class="layui-input-block">
                    <textarea class="layui-textarea" name="seointroduction"><?php echo htmlentities($data['seointroduction']); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item public-center">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="submit">立即提交</button>
            </div>
        </form>

    </div>

</div>

<script src="/lmgadmin/js/web.js"></script>