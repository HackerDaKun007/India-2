<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 流量日期
// +----------------------------------------------------------------------
namespace app\common\model;
use think\Exception;

class Flowdate extends Common {

    public function add($url) {

        self::startTrans();
        try {
            $ip = new \app\commonConfig\Ip();
            $Pv =  Model('Pv');
            $Uv =  Model('Uv');
            $date = strtotime(date('Ymd')); //今天日期
            $dateFlow = $this->cache::get($this->path['dateFlow']."_$date");
//        $this->cache::rm($this->path['dateFlow']."_$date");
//        $this->cache::rm($this->path['uv']."_$date");
//        $this->cache::rm($this->path['pv']."_$date");
//        exit;
            $timedate = time();
            $time = $this->path['time1'];
            if(!$dateFlow) {
                $data = self::where('date','=',$date)->find();
                if(!$data) { //查询没有数据
                    $data = [
                        'date' => $date,
                        'pv' => 1,
                        'uv' => 1,
                    ];
                    //添加数据
                    self::isUpdate(false)->save($data);
                    $data['flowdate_id'] = $this->id;
                }else {
                    $data = json_decode($data,true);
                }
                $this->cache::set($this->path['dateFlow']."_$date",$data,$time);
                $Pv->add($data,false,$url,$timedate,$ip);
                $Uv->add($data,false,$timedate,$ip);
            self::commit();
            }else {
                $dateFlow['pv'] += 1;
                $data['pv'] = $dateFlow['pv'];
                if(self::isUpdate(true)->save($data,['flowdate_id'=>$dateFlow['flowdate_id']])) {
                    $this->cache::set($this->path['dateFlow']."_$date",$dateFlow,$time);
                    $Pv->add($dateFlow,true,$url,$timedate,$ip);
                };
                $Uv->add($dateFlow,true,$timedate,$ip);
            self::commit();
            }
        }catch (Exception $e) {
            self::rollback();
        }

    }




    //展示
    public function show($get,$where) {
        $data = self::where($where)->order('date desc')->paginate($get['limit'],true,['page'=>$get['page']])->toArray();
        $count = self::where($where)->count();
        return self::dataJson(1,'success',[
            'data' => $data['data'],
            'count' => $count,
        ],'',true);
    }

}
?>