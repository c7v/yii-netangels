<?php

namespace c7v\yii_netangels\requesters\hosting;

use c7v\yii_netangels\HttpClientException;
use c7v\yii_netangels\requesters\BaseRequester;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Class Container
 * @package c7v\yii_netangels\requesters\hosting
 */
class Container extends BaseRequester
{
    const URL = 'hosting/containers/';

    const ENVIRONMENT_CLOUD_HOST = 0;
    const ENVIRONMENT_VIRTUAL_HOST = 1;
    const ENVIRONMENT_CLOUD_HOST_NEW = 2;

    /**
     * @param string $name
     * @param int $memory_limit
     * @param int $quota
     * @param int $environment
     * @param array $config
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function create(string $name, int $memory_limit, int $quota, int $environment, array $config = [])
    {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL)
            ->setMethod('POST')
            ->setData(ArrayHelper::merge([
                'name' => $name,
                'memory_limit' => $memory_limit,
                'quota' => $quota,
                'environment' => $environment,
            ], $config));

        return $this->processResponse($request);
    }

    /**
     * @param int|null $offset
     * @param int|null $limit
     * @return array
     * @throws HttpClientException
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getList(int $offset = null, int $limit = null)
    {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL)
            ->setData([
                'offset' => $offset,
                'limit' => $limit,
            ]);
        
        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws HttpClientException
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getById(int $id){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.''.$id)
            ->setMethod('GET');

        return $this->processResponse($request);
    }

    /**
     * @param int $site_id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function sessionSwitchRedis(int $site_id){
        $request = self::$_httpClient
            ->initHttpRequest(Site::URL.$site_id.'/redis-session-switch/')
            ->setMethod('PUT');

        return $this->processResponse($request);
    }
    
    /**
     * @param int $id
     * @param int $memory_limit
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function settingRedis(int $id, int $memory_limit){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id.'/redis/')
            ->setMethod('POST')
            ->setData([
                'memory_limit' => $memory_limit
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @param int $memory_limit
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function settingMemcached(int $id, int $memory_limit){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id.'/memcache/')
            ->setMethod('POST')
            ->setData([
                'memory_limit' => $memory_limit
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @param array $config
     * @return array
     * @throws HttpClientException
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function update(int $id, array $config){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.''.$id)
            ->setMethod('PUT')
            ->setData($config);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function deleteMemcache(int $id){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id.'/memcache/')
            ->setMethod('DELETE');

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function deleteRedis(int $id){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id.'/redis/')
            ->setMethod('DELETE');

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws HttpClientException
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function delete(int $id){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.''.$id)
            ->setMethod('DELETE');

        return $this->processResponse($request);
    }
}