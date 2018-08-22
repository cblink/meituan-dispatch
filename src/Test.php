<?php


namespace Cblink\MeituanDispatch;


class Test extends Api
{
    /**
     * 模拟接单
     *
     * @param $deliveryId
     * @param $peisongId
     * @return mixed
     * @throws MeituanDispatchException
     */
    public function arrange($deliveryId, $peisongId)
    {
        return $this->request('test/order/arrange', ['delivery_id' => $deliveryId, 'mt_peisong_id' => $peisongId]);
    }

    /**
     * 模拟取货
     *
     * @param $deliveryId
     * @param $peisongId
     * @return mixed
     * @throws MeituanDispatchException
     */
    public function pickup($deliveryId, $peisongId)
    {
        return $this->request('test/order/pickup', ['delivery_id' => $deliveryId, 'mt_peisong_id' => $peisongId]);
    }

    /**
     * 模拟送达
     *
     * @param $deliveryId
     * @param $peisongId
     * @return mixed
     * @throws MeituanDispatchException
     */
    public function deliver($deliveryId, $peisongId)
    {
        return $this->request('test/order/deliver', ['delivery_id' => $deliveryId, 'mt_peisong_id' => $peisongId]);
    }

    /**
     * 模拟改派
     *
     * @param $deliveryId
     * @param $peisongId
     * @return mixed
     * @throws MeituanDispatchException
     */
    public function rearrange($deliveryId, $peisongId)
    {
        return $this->request('test/order/rearrange', ['delivery_id' => $deliveryId, 'mt_peisong_id' => $peisongId]);
    }

    /**
     * 模拟上传异常
     *
     * @param $deliveryId
     * @param $peisongId
     * @return mixed
     * @throws MeituanDispatchException
     */
    public function reportException($deliveryId, $peisongId)
    {
        return $this->request('test/order/reportException', ['delivery_id' => $deliveryId, 'mt_peisong_id' => $peisongId]);
    }
}