# meituan-dispatch

## Install

```
composer require cblink/meituan-dispatch -vvv
```

# Usage

```php
<?php

$dispatch = new \Cblink\MeituanDispatch\Dispatch([
    'app_key' => 'your-app-key',
    'secret' => 'your-secret',
    'debug' => true,
    'log' => [
        'name' => 'meituan',
        'file' => __DIR__ . '/meituan.log',
        'level' => 'debug',
        'permission' => 0777,
    ],
]);

// 根据门店创建订单
$dispatch->createByShop([
    'delivery_id' => 1,
    'order_id' => 1,
    'shop_id' => 'test_0001',
    'delivery_service_code' => 4011,
    'receiver_name' => 'hanson',
    'receiver_address' => 'sdf',
    'receiver_phone' => '18922222222',
    'receiver_lng' => 113.95317005 * 10^6,
    'receiver_lat' => 22.53914005 * 10^6,
    'goods_value' => 1,
    'goods_weight' => 1,
]);

$params = [];

//查询订单状态 
$dispatch->queryStatus($params);

// 订单创建(送货分拣方式)
$dispatch->createByCoordinates($params);

// 删除订单
$dispatch->delete($params);

// 评价骑手
$dispatch->evaluate($params);

// 配送能力校验
$dispatch->check($params);

// 获取骑手当前位置
$dispatch->location($params);
```