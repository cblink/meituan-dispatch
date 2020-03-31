<?php
namespace Cblink\MeituanDispatch\Tests;

use PHPUnit\Framework\TestCase;
use Cblink\MeituanDispatch\Dispatch;

class TestOrder extends TestCase
{
    protected $secret = '';

    protected $appKey = '';

    /**
     * 创建订单
     *
     */
    public function testCreateOrShop()
    {
        $goods[] = [
            'goodCount' => 2,
            'goodName' => '测试商品',
        ];

        $data = [
            'delivery_id' => 1,
            'order_id' => 1,
            'poi_seq' => '40001', // 美团的流水号加4为前缀
            'shop_id' => 'test_0001',
            'delivery_service_code' => 4011,
            'receiver_name' => 'test',
            'receiver_address' => '中国',
            'receiver_phone' => '',
            'receiver_lng' => (int) (113.957613 * pow(10, 6)),
            'receiver_lat' => (int) (22.538135 * pow(10, 6)),
            'goods_value' => 100,
            'goods_weight' => 1,
            'goods_detail' => json_encode(['goods' => $goods]),
        ];

        $result = (new Dispatch(['app_key' => $this->appKey, 'secret' => $this->secret, 'debug' => false]))->createByShop($data);

        $this->assertArrayHasKey('data', $result);
    }

    /**
     * 查询订单状态
     *
     */
    public function testQueryStatus()
    {
        $result = (new Dispatch([
            'app_key' => $this->appKey,
            'secret' => $this->secret,
            'debug' => false
        ]))->queryStatus([
            'mt_peisong_id' => '',
            'delivery_id' => ''
        ]);

        $this->assertArrayHasKey('data', $result);
    }

    /**
     * 删除订单
     */
    public function testDelete()
    {
        $result = (new Dispatch([
            'app_key' => $this->appKey,
            'secret' => $this->secret,
            'debug' => false,
        ]))->delete([
            'mt_peisong_id' => '',
            'delivery_id' => '',
            'cancel_reason_id' => '',   // 取消原因类别，默认为接入方原因
            'cancel_reason' => '',  // 详细取消原因，最长不超过256个字符
        ]);

        $this->assertArrayHasKey('data', $result);
    }

    /**
     * 评价骑手
     */
    public function testEvaluate()
    {
        $result = (new Dispatch([
            'app_key' => $this->appKey,
            'secret' => $this->secret,
            'debug' => false,
        ]))->evaluate([
            'mt_peisong_id' => '',
            'delivery_id' => '',
            'score' => '', // 评分（5分制）
            'comment_content' => '',  // 评论内容（评论的字符长度需小于1024）
        ]);

        $this->assertArrayHasKey('data', $result);
    }

    /**
     * 配送能力校验
     */
    public function testCheck()
    {
        $result = (new Dispatch([
            'app_key' => $this->appKey,
            'secret' => $this->secret,
            'debug' => false,
        ]))->check([
            'shop_id' => '',
            'delivery_service_code' => '',  // 配送服务代码
            'receiver_address' => '', // 收件人地址，最长不超过 512 个字符
            'receiver_lng' => '',  // 收件人经度
            'receiver_lat' => '',   // 收件人纬度
            'coordinate_type' => '',    // 坐标类型
            'check_type' => '', // 预留字段，方便以后扩充校验规则，check_type = 1
            'mock_order_time' => '',    // 模拟发单时间，时区为 GMT+8，当前距离 Epoch（1970年1月1日) 以秒计算的时间
        ]);

        $this->assertArrayHasKey('data', $result);
    }

    /**
     * 获取骑手当前位置
     */
    public function testLocation()
    {
        $result = (new Dispatch([
            'app_key' => $this->appKey,
            'secret' => $this->secret,
            'debug' => false,
        ]))->location([
            'delivery_id' => '',
            'mt_peisong_id' => '',  // 美团配送内部订单 id
        ]);

        $this->assertArrayHasKey('data', $result);
    }
}