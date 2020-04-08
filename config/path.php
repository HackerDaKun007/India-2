<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 公共操作变量
// +----------------------------------------------------------------------

return [
    //controller方法名控制
    'contr' => 'controller',

    //数据缓存
    'modelPowerW1' => 'modelPowerWhether1',  //权限表列表展示栏目1
    'modelPowerW2' => 'modelPowerWhether2',  //权限表列表展示栏目2
    'modelPowerW3' => 'modelPowerWhether3',  //权限表列表展示栏目3
    'modelPowerShow' => 'modelPowerShow',   //权限表列表展示

    //角色目录权限缓存
    'modelRoleShow' => 'modelRoleShow',   //权限表列表根据角色展示栏目
    'modelRoleSelect' => 'modelRoleSelect',   //权限表列表根据角色展示权限列表

    'runtime' => './runtime/', //后端上传缓存文件地址
    'upload' => './Upload/', //后端上传文件地址
    'uploadEnd' => '/Upload/', //后端上传文件地址
    'default' => './', //默认地址

    //登陆后台使用的cookie信息
    'cokieUser' => 'cokieUser', //用户名称
    'cokieId' => 'cokieId', //用户ID
    'cokieIp' => 'cokieIp', //用户ip
    'cokieBr' => 'cokieBr', //用户游览器
    'cokieOs' => 'cokieOs', //用户系统
    'cokieTime' => 'cokieTime', //用户系统

    //管理员信息
    'adminInfo_' => 'adminInfo_',


    //产品缓存
    'goodsCache' => 'goodsCache',

    //付款方式
    'goodsPayment' => [
        1 => '货到付款',  //货到付款
    ],

    //订单状态
    'goodsStatus' => [
        1 => '待发货',
        2 => '待收货',
        3 => '确定收货',
        4 => '取消',
        5 => '待确定',
        6 => '退货',
        7 => '售后服务',
    ],

    //提交数据加密
    'dataPassword' => 'dakun007@qq.com,gzlmgvip',

    //日期流量
    'dateFlow' => 'dateFlow',
    'pv' => 'pv',
    'uv' => 'uv',

    //时间秒
    'time30' => (3600*24)*30, //一个月
    'time7' => (3600*24)*7,  //七天
    'time1' => (3600*24)*1, //1天


    //网站设置缓存
    'webUpload' => 'webUpload',

    //产品归类列表
    'goodsClassify' => 'goodsClassify',

    //网站相关页面缓存信息
    'Aboutus' => 'Aboutus', //关于我们

    //网站相关页面缓存信息
    'Shippinginfo' => 'Shippinginfo',//货运信息

    //网站相关页面缓存信息
    'Faq' => 'Faq',//常问问题

    //网站相关页面缓存信息
    'Contactus' => 'Contactus',//联系我们

    //网站相关页面缓存信息
    'Returnpolicy' => 'Returnpolicy',//联系我们

    //网站相关页面缓存信息
    'Termsconditions' => 'Termsconditions',//条款条件

    //网站相关页面缓存信息
    'Privacypolicy' => 'Privacypolicy',//隐私政策
];

?>