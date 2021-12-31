<?php

namespace c7v\yii_netangels\requesters\cloud;

use c7v\yii_netangels\requesters\BaseRequester;
use c7v\yii_netangels\requesters\cloud\Vds;
use yii\base\InvalidConfigException;

/**
 * Class Image
 * @package c7v\yii_netangels\requesters\cloud
 */
class Image extends BaseRequester
{
    const URL = 'cloud/images/';
    /**
     * @param int $offset
     * @param int $limit
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function createImage(int $id, string $name = null) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id . '/archive/')
            ->setMethod('POST')
            ->setData([
                'name' => $name,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @param string|null $image
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function reinstallImage(int $id, string $image) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id . '/reinstall-image/')
            ->setMethod('POST')
            ->setData([
                'image' => $image,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getListDistributions() {
        $request = self::$_httpClient->initHttpRequest('cloud/distributions/')->setMethod('GET');

        return $this->processResponse($request);
    }

    /**
     * @param array $config
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getList(array $config = []) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL)
            ->setMethod('GET')
            ->setData($config);

        return $this->processResponse($request);
    }

    /**
     * @param array $config
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getReady(array $config = []) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . 'ready/')
            ->setMethod('GET')
            ->setData($config);

        return $this->processResponse($request);
    }

    /**
     * @param int $uid
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getInfo(int $uid) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $uid)
            ->setMethod('GET');

        return $this->processResponse($request);
    }

    /**
     * @param int $uid
     * @param string $name
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function changeName(int $uid, string $name) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $uid)
            ->setMethod('PUT')
            ->setData([
                'name' => $name
            ]);

        return $this->processResponse($request);
    }
}