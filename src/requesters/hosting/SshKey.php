<?php

namespace c7v\yii_netangels\requesters\hosting;

use c7v\yii_netangels\requesters\BaseRequester;
use yii\base\InvalidConfigException;

/**
 * Class SshKey
 * @package c7v\yii_netangels\requesters\hosting
 */
class SshKey extends BaseRequester
{

    const URL = 'hosting/containers/';

    /**
     * @param int $id
     * @param string $key
     * @param string|null $name
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function create(int $id, string $key, string $name = null){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id.'/ssh/create/')
            ->setMethod('POST')
            ->setData([
                'key' => $key,
                'name' => $name,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @param int $key_id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function added(int $id, int $key_id){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id.'/ssh/upload/')
            ->setMethod('POST')
            ->setData([
                'key_id' => $key_id,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @param int|null $offset
     * @param int|null $limit
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getList(int $id, int $offset = null, int $limit = null)
    {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id.'/ssh/')
            ->setData([
                'offset' => $offset,
                'limit' => $limit,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @param int $key_id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function delete(int $id, int $key_id){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id.'/ssh/'.$key_id.'/')
            ->setMethod('DELETE');

        return $this->processResponse($request);
    }
}