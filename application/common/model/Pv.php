<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5.1 [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: dakun007 <dakun007@hotmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | PV
// +----------------------------------------------------------------------
namespace app\common\model;
class Pv extends Common {

    //
    public function add($data,$bool=false,$url,$time,$ip) {
        $path = $this->cache::get($this->path['pv']."_$data[date]");
        $ipadd = $ip->Ipaddr();
        if(!$bool) { //添加
            $arr = [
                'ip' => $ip->passIp($ipadd['ip']),
                'ipadder' => $ipadd['country'],
                'num' => 1,
                'addtime' => time(),
                'flowdate_id' => $data['flowdate_id'],
                'url' => $url,
            ];
            if(self::isUpdate(false)->save($arr)) {
                $arr['pv_id'] = $this->id;
                if($path) {
                    $path[count($path)] = $arr;
                }else {
                    $path = [];
                    $path[0] = $arr;
                }
                $this->cache::set($this->path['pv']."_$data[date]",$path,$time);
            }
        }else { //修改
            $bool = false;
            $key = '';
            $id = '';
            $num = 0;
            if($path && is_array($path)) {
                foreach($path as $k => $v) {
                    if($v['ip'] == $ip->passIp($ipadd['ip']) && $v['url'] == $url) {
                        $bool = true;
                        $key = $k;
                        $id = $v['pv_id'];
                        $num = $v['num']+1;
                        break;
                    }
                }
            }
            if($bool) {  //true
                //修改
                $da['num'] = $num;
                if(self::isUpdate(true)->save($da,['pv_id'=>$id])) {
                    $path[$key]['num'] = $num;
                    $this->cache::set($this->path['pv']."_$data[date]",$path,$time);
                }
            }else {
                //添加
               $this->add($data,false,$url,$time,$ip);
            }
        }
    }


    //展示
    public function show($get,$where) {
        $data = self::where($where)->order('pv_id desc')->paginate($get['limit'],true,['page'=>$get['page']])->each(function($user) {
            $user['ip'] = Long2ip($user['ip']);
            return $user;
        })->toArray();
        $count = self::where($where)->count();
        return self::dataJson(1,'success',[
            'data' => $data['data'],
            'count' => $count,
        ],'',true);
    }

}

?>