layui.use(['form','upload'], function() {
    var form = layui.form
        ,upload = layui.upload
        ,layer = layui.layer;

    var url = $.Public.url + 'web/';

    var logo = '';
    var ico = '';
    function Img(str,val) {
        let img = '';
        let uploadInst = upload.render({
            elem: str
            ,url:  url + 'index.html'
            ,data:{
                request:201,  //配置上传
            }
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    img = result;
                });
            }
            ,done: function(res){
                //上传成功
                if(res.code == 1){
                    $(str).attr('src', img); //图片链接（base64）
                    if(val == 1) {
                        logo = res.data;
                    }else {
                        ico = res.data;
                    }
                    return layer.msg('上传成功',{icon:1,time:500});
                }else {
                    if(val == 1) {
                        logo = '';
                    }else {
                        ico = '';
                    }
                    return layer.msg('上传失败',{icon:2,time:500});
                }
            }
        });
    }

    Img('.logo',1);
    Img('.ico',2);

    //监听提交
    form.on('submit(submit)', function(data){
        var action = data.form.action;
        var field = data.field;
        field.logo = logo; //头像
        field.ico = ico; //头像
        $.Public.post({
            type:'post',
            url: action,
            data: field,
            success: function() {
                logo = '';
                ico = '';
            },
        });
        return false;
    });
});