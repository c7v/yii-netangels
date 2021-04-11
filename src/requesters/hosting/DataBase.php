<?php

namespace c7v\yii_netangels\requesters\hosting;

use c7v\yii_netangels\requesters\BaseRequester;
use yii\base\InvalidConfigException;

/**
 * Class DataBase
 * @package c7v\yii_netangels\requesters\hosting
 */
class DataBase extends BaseRequester
{
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
            ->initHttpRequest('hosting/dbms/'.$id.'/databases/')
            ->setData([
                'offset' => $offset,
                'limit' => $limit,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @param string $password
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function setPassword(int $id, string $password)
    {
        $request = self::$_httpClient
            ->initHttpRequest('hosting/dbms/'.$id.'/set-password/')
            ->setMethod('PUT')
            ->setData([
                'password' => $password
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $virtualhost_id
     * @param string $charset
     * @param string $name
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function create(int $virtualhost_id, string $charset, string $name)
    {
        $request = self::$_httpClient
            ->initHttpRequest('hosting/dbms/databases/')
            ->setMethod('POST')
            ->setData([
                'virtualhost_id' => $virtualhost_id,
                'name' => $name,
                'charset' => $charset,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function delete(int $id)
    {
        $request = self::$_httpClient
            ->initHttpRequest('hosting/dbms/databases/'.$id)
            ->setMethod('DELETE');

        return $this->processResponse($request);
    }
}