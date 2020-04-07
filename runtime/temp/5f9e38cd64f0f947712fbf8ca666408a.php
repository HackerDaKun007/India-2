<?php /*a:1:{s:57:"D:\www\India-2\application\lmgadmin\view\power\index.html";i:1586238373;}*/ ?>
<div class="public-backdrop-white">

    <!--  搜索  -->
    <div class="public-search">

    </div>

    <!--  内容   -->
    <div class="public-content">

        <!--    添加等操作    -->
        <div class="public-column-bottom-10">
            <button class="layui-btn public-btn-sm add-1" >添加1级</button>
            <button class="layui-btn public-btn-sm add-2" >添加2级</button>
            <button class="layui-btn public-btn-sm add-3" >添加3级</button>
            <button class="layui-btn public-btn-sm renew layui-btn-normal" >更新缓存</button>
        </div>

        <!--   展示区域     -->
        <table class="layui-table">
            <colgroup>
                <col width="100">
                <col>
                <col width="150">
                <col width="150">
                <col width="200">
            </colgroup>
            <thead>
            <tr>
                <th></th>
                <th>名称</th>
                <th>排序</th>
                <th>是否展示栏目</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($cacheShow as $v): ?>
                <tr>
                    <td>
                        <?php if(!empty($v['grade2'])): ?>
                            <i class="layui-icon layui-icon-triangle-d"></i>
                        <?php else: ?>
                            <i class="layui-icon layui-icon-file"></i>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlentities($v['username']); ?></td>
                    <td><?php echo htmlentities($v['sort']); ?></td>
                    <td>
                        <?php if($v['whether'] == 1): ?>
                            <button type="button" class="layui-btn layui-btn-normal layui-btn-xs">是</button>
                        <?php else: ?>
                            <button type="button" class="layui-btn layui-btn-primary layui-btn-xs">否</button>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a class="layui-btn layui-btn-xs edit1" lay-id="<?php echo htmlentities($v['power_id']); ?>" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
                        <a class="layui-btn layui-btn-danger layui-btn-xs del" lay-id="<?php echo htmlentities($v['power_id']); ?>" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
                    </td>
                </tr>
                <?php if(!empty($v['grade2'])): foreach($v['grade2'] as $ve): ?>
                        <tr>
                            <td>
                                <?php if(!empty($ve['grade3'])): ?>
                                <i class="layui-icon layui-icon-triangle-d public-padding-left-15"></i>
                                <?php else: ?>
                                <i class="layui-icon layui-icon-file public-padding-left-15"></i>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlentities($ve['username']); ?></td>
                            <td><?php echo htmlentities($ve['sort']); ?></td>
                            <td>
                                <?php if($ve['whether'] == 1): ?>
                                <button type="button" class="layui-btn layui-btn-normal layui-btn-xs">是</button>
                                <?php else: ?>
                                <button type="button" class="layui-btn layui-btn-primary layui-btn-xs">否</button>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a class="layui-btn layui-btn-xs edit2" lay-id="<?php echo htmlentities($ve['power_id']); ?>" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
                                <a class="layui-btn layui-btn-danger layui-btn-xs del" lay-id="<?php echo htmlentities($ve['power_id']); ?>" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
                            </td>
                        </tr>
                        <?php if(!empty($ve['grade3'])): foreach($ve['grade3'] as $vu): ?>
                            <tr>
                                <td>
                                    <i class="layui-icon layui-icon-file public-padding-left-25"></i>
                                </td>
                                <td><?php echo htmlentities($vu['username']); ?></td>
                                <td><?php echo htmlentities($vu['sort']); ?></td>
                                <td>
                                    <button type="button" class="layui-btn layui-btn-primary layui-btn-xs">否</button>
                                </td>
                                <td>
                                    <a class="layui-btn layui-btn-xs edit3" lay-id="<?php echo htmlentities($vu['power_id']); ?>" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
                                    <a class="layui-btn layui-btn-danger layui-btn-xs del" lay-id="<?php echo htmlentities($vu['power_id']); ?>" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>

            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script type="application/json" id="controller"><?php echo $controller; ?></script>
<script type="application/json" id="PowerW1"><?php echo $PowerW1; ?></script>
<script type="application/json" id="PowerW2"><?php echo $PowerW2; ?></script>
<script type="application/json" id="PowerW3"><?php echo $PowerW3; ?></script>

<script src="/lmgadmin/js/power.js"></script>