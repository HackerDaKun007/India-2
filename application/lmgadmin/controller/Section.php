<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liuzhenjia <605130343@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 页面栏目
// +----------------------------------------------------------------------
namespace app\lmgadmin\controller;
use app\common\validate\Section as validate;
use app\common\model\Section as model;

class Section extends Common {

    protected $folderUrl = '../application/home/view/ht/';

    //页面列表
    public function index() {
        $model = new model();
        $input = $this->request->get();
        //列表展示
        if(self::yzGetShow($input)) {
            $array = [];
            $count = 0;
            $success = '';
            $validate = Validate('Page');
            if(!$validate->check($input)) {
                $success = $validate->getError();
            }else {
                $where = [];
                if(!empty($input['username'])) {
                    $where[] = ['username', 'like', "%$input[username]%"];
                }
                $data = $model->showList($input, $where, $this->cache);
                $array = $data['data']['data'];
                $count = $data['data']['count'];
            }
            echo self::layuiJson($array, $count, '', $success);
            exit;
        }
        //编辑展示
        if (self::yzPostAdd()) {
            $code = 0;
            $msg = '数据缺失条件';
            $file = '';
            $post = $this->request->post();
            if(!empty($post['title'])) {
                $file = $model->show($post, $this->folderUrl . '/', $post['title'].'.html');
                $code = 1;
                $msg = 'html文本获取成功';
            }
            echo self::dataJson($code, $msg, $file);
            exit;
        }
        //获取分类信息
        $model = new \app\common\model\Sectionsort();
        $sectionsort = $model->field('sectionsort_id,remark')->order('sectionsort_id desc')->select();
        return view('', [
            'sort' => $sectionsort ,
        ]);
    }

    /**创建文件
     * @param string $htmlfile 生成的静态文件名称
     * @param string $htmlpath 生成的静态文件路径
     * @param string $templateFile 指定要调用的模板文件
     * * 默认为空 由系统自动定位模板文件
     * @return mixed
     * @throws \think\Exception
     */
    //protected function buildHtml($htmlfile = '', $htmlpath = '', $templateFile = '')
    //{
    //    $content = $this->fetch($templateFile);
    //    $htmlpath = !empty($htmlpath) ? $htmlpath : './appTemplate/';
    //    $htmlfile = $htmlpath . $htmlfile . '.'.config('url_html_suffix');
    //    $File = new \think\template\driver\File();
    //    $File->write($htmlfile, 'a');
    //    return $content;
    //}
    //调用 $this->buildHtml($data['username'], '../public/tpl/', '../public/tpl/index.html');

    //添加页面，并添加到相应文件夹
    public function add() {
        $msg = 'error';
        $code = 0;
        if(self::yzPostAdd()) {
            $data = $this->request->post();
            $validate = new validate();
            if(!$validate->scene('add')->check($data)) {
                $msg = $validate->getError();
            } else {
                $model = new model();
                $res = $model->add($data, $this->cache);
                if (!$res) {
                    $msg = '页面已存在';
                } else {
                    $code = $res['code'];
                    $msg = $res['msg'];
                }
            }
        }
        echo self::dataJson($code, $msg);
    }

    //删除
    public function del() {
        $code = 0;
        $msg = 'error';
        if(self::yzPostAdd()) {
            $data = $this->request->post();
            $validate = new validate();
            if(!$validate->scene('del')->check($data)) {
                $msg = $validate->getError();
            } else {
                $model = new model();
                $res = $model->del($data, $this->cache);
                if (!$res) {
                    $msg = '文件删除失败';
                } else {
                    $code = $res['code'];
                    $msg = $res['msg'];
                }
            }
        }
        echo self::dataJson($code, $msg,$data);
    }

    //修改
    public function edit() {
        $code = 0;
        $msg = 'error';
        if(self::yzPostAdd()) {
            $data = $this->request->post();
            $validate = new validate();
            if(!$validate->scene('edit')->check($data)) {
                $msg = $validate->getError();
            } else {
                $model = new model();
                $res = $model->edit($data, $this->folderUrl, $this->cache);
                $code = $res['code'];
                $msg = $res['msg'];
            }
        }
        echo self::dataJson($code, $msg);
    }

}