<?php


namespace Cblink\MeituanDispatch;


use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{

    /**
     * @var string
     */
    private $appKey;

    /**
     * @var string
     */
    private $secret;

    const URL = 'https://peisongopen.meituan.com/api/';

    public function __construct(string $appKey, string $secret)
    {
        $this->appKey = $appKey;
        $this->secret = $secret;
    }

    /**
     * @param string $method
     * @param array $params
     * @return mixed
     * @throws MeituanDispatchException
     */
    public function request(string $method, array $params)
    {
        $params = array_merge($params, [
            'appkey' => $this->appKey,
            'timestamp' => time(),
            'version' => '1.0',
        ]);

        $params['sign'] = $this->signature($params);

        $http = $this->getHttp();

        $response = $http->post(self::URL . $method, $params);

        $result = json_decode(strval($response->getBody()), true);

        $this->checkErrorAndThrow($result);

        return $result;
    }

    public function signature(array $params)
    {
        ksort($params);

        $waitSign = '';
        foreach ($params as $key => $item) {
            if ($item) {
                $waitSign .= $key.$item;
            }
        }

        return strtolower(sha1($this->secret.$waitSign));
    }

    /**
     * @param $result
     * @throws MeituanDispatchException
     */
    private function checkErrorAndThrow($result)
    {
        if (!$result || $result['code'] != 0) {
            throw new MeituanDispatchException($result['message'], $result['code']);
        }
    }
}