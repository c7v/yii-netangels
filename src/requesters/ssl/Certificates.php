<?php

namespace c7v\yii_netangels\requesters\hosting;

use c7v\yii_netangels\requesters\BaseRequester;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Class Site
 * @package c7v\yii_netangels\requesters\hosting
 */
class Certificates extends BaseRequester
{
    const URL = 'certificates/';

    /**
     * @param int $offset
     * @param int $limit
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getList(int $offset, int $limit){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL)
            ->setMethod('GET')
            ->setData([
                'offset' => $offset,
                'limit' => $limit,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $certificate
     * @param int $private_key
     * @param array $config
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function setNewCertificate(int $certificate, int $private_key, array $config = []){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL)
            ->setMethod('POST')
            ->setData(ArrayHelper::merge([
                'certificate' => $certificate,
                'private_key' => $private_key,
            ], $config));

        return $this->processResponse($request);
    }

    /**
     * @param int $domains
     * @param array $config
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function orderingNewCertificate(int $domains, array $config = []){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . 'order/')
            ->setMethod('POST')
            ->setData(ArrayHelper::merge([
                'domains' => $domains,
            ], $config));

        return $this->processResponse($request);
    }

    /**
     * @param int $domains
     * @param array $config
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function findSsl(int $domains, array $config = []){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . 'find/')
            ->setMethod('GET')
            ->setData(ArrayHelper::merge([
                'domains' => $domains,
            ], $config));

        return $this->processResponse($request);
    }

    /**
     * @param int $ssl_id
     * @param array $config
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function update(int $ssl_id, array $config = []){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $ssl_id)
            ->setMethod('PUT')
            ->setData(ArrayHelper::merge([
                'id' => $ssl_id,
            ], $config));

        return $this->processResponse($request);
    }

    /**
     * @param int $ssl_id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function delete(int $ssl_id){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $ssl_id)
            ->setMethod('DELETE')
            ->setData([
                'id' => $ssl_id,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $ssl_id
     * @param array $config
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function download(int $ssl_id, array $config = []){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . 'download/')
            ->setMethod('GET')
            ->setData(ArrayHelper::merge([
                'id' => $ssl_id,
            ], $config));

        return $this->processResponse($request);
    }

    /**
     * @param int $ssl_id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function renewal(int $ssl_id){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . 'renewal/')
            ->setMethod('PUT')
            ->setData([
                'id' => $ssl_id,
            ]);

        return $this->processResponse($request);
    }
}