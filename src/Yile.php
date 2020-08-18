<?php
/**
 * @api 亿乐社区API http://社区域名.api.94sq.cn/api/
 * @author XFS-小风
 * @url http://xfs0.cn
 */

namespace XFS\Api;

use Curl\Curl;

/**
 * 亿乐社区集成接口类
 * Class Yile
 * @package App\Http\Controllers\Post
 */
class Yile
{
    /**
     * @var int $id 对接账户ID
     */
    protected $id;
    /**
     * @var string $url 对接URL
     */
    protected $url;
    /**
     * @var array $this->otherParams 对接的其他参数,可以查看亿乐社区Api文档
     *
     */
    protected $otherParams;
    /**
     * @var string 密钥
     */
    protected $password;
    /**
     *
     * Yile constructor.
     * @param string $domain 域名
     * @param int $id 用户编号
     * @param string $password 密钥
     *
     */
    public function __construct($domain,$id,$password)
    {
        $this->id = $id;
        $this->url = 'http://'.$domain.'.api.94sq.cn/api/' ;
        $this->password = $password;
    }
    /**
     * 获取验证包
     * @param $params
     * @param $key
     * @return string
     */
    protected function getSign($params,$key)
    {
        $signPars = "";
        ksort($params);
        foreach ($params as $k => $v) {
            if ($k != "sign") {
                $signPars .= $k . "=" . $v . "&";
            }
        }
        $signPars = trim($signPars, '&');
        $signPars .= $key;
        $sign = md5($signPars);
        return $sign;
    }
    /**
     * 获取对接参数
     * @return array
     */
    protected function getParams()
    {
        $sign = "";
        $id = $this->id;
        $params = [
            'api_token' => $this->id,
            'timestamp' => strtotime('now'),
            'sign' => $sign,
        ];
        $params = array_merge($params,$this->otherParams);
        $sign = $this->getSign($params,$this->password);
        $params['sign'] = $sign;
        return $params;
    }
    /**
     * 获取并修改对接状态,为了保持统一
     * @param int  $status 实时对接状态
     * @return int
     */
    protected function getStatus($status)
    {
        if($status == 1 ){
            $status = 1;
        }else{
            $status = 0;
        }
        return $status;
    }
    /**
     * 执行对接请求
     * @param string $url 执行post对接请求的单向路径
     * @return |null
     */
    protected function curlYileApi($url)
    {
        $params = $this->getParams();
        $curl = new Curl();
        $curl->post($this->url .$url, $params);
        $curl->response->status = $this->getStatus($curl->response->status);
        return $curl->response;
    }
    /**
     * 获取商品详细信息
     * @param int $gid 商品ID
     * @return |null
     */
    public function getGoodInfo($gid)
    {
        $this->otherParams = ['gid'=>$gid];
        return $this->curlYileApi('goods/info');
    }
    /**
     * 获取商品列表
     * @return |null
     */
    public function getGoodList(){
        return $this->curlYileApi('goods/list');
    }

    /**
     * 购买商品,下订单
     * @param $num
     * @param array $val 商品参数
     * @return  |null
     */
    public function order($num, array $val)
    {
        $this->otherParams = $val;
        return $this->curlYileApi('order');
    }
    /**
     * 前台订单查询,支持批量查询
     * @param int $oid 订单号
     * @param string $orderIds 批量查询订单 123,456,789 的格式
     * @return |null
     */
    public function queryOrder($oid, $orderIds='')
    {
        if ($orderIds != '') {
            $this->otherParams['ids'] = $orderIds;
        }
        $this->otherParams['id'] = $oid;
        return $this->curlYileApi('order/query');
    }
    /**
     * 前台操作订单
     * @param int $oid 订单号
     * @param int $status 订单操作 2退单 4补单 5改密
     * @param string $password 修改订单密码 （status=5时此参数必填，仅仅对有密码内容的订单有效）
     * @return |null
     */
    public function actOrder($oid,$status,$password = '')
    {
        $this->otherParams['id'] = $oid;
        $this->otherParams['status'] = $status;
        if($status == ''){
            $this->otherParams['password'] = $password;
        }
        return $this->curlYileApi('order/action');
    }
}
