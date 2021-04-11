<?php

namespace c7v\yii_netangels\requesters\hosting;

use c7v\yii_netangels\requesters\BaseRequester;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Class Site
 * @package c7v\yii_netangels\requesters\hosting
 */
class Site extends BaseRequester
{
    const URL = 'hosting/virtualhosts/';

    /**
     * @param int $container_id
     * @param string $name
     * @param string $engine
     * @param string $dbms_type
     * @param array $params
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function create(int $container_id, string $name, string $engine, string $dbms_type, array $params = []){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL)
            ->setMethod('POST')
            ->setData(ArrayHelper::merge([
                'container_id' => $container_id,
                'name' => $name,
                'engine' => $engine,
                'dbms_type' => $dbms_type,
            ], $params));

        return $this->processResponse($request);
    }

    /**
     * @param int $container_id
     * @param string $name
     * @param string $image
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function createCRM(int $container_id, string $name, string $image){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.'install/')
            ->setMethod('POST')
            ->setData([
                'container_id' => $container_id,
                'name' => $name,
                'image' => $image,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int|null $offset
     * @param int|null $limit
     * @return array
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
     * @param int|null $offset
     * @param int|null $limit
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getListContainer(int $id, int $offset = null, int $limit = null)
    {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id.'/virtualhosts/')
            ->setData([
                'offset' => $offset,
                'limit' => $limit,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getById(int $id)
    {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id);

        return $this->processResponse($request);
    }

    /**
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getConstants(){
        $request = self::$_httpClient
            ->initHttpRequest('hosting/constants/')
            ->setMethod('GET');

        return $this->processResponse($request);
    }

    /**
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getInfo(){
        $request = self::$_httpClient
            ->initHttpRequest('hosting/')
            ->setMethod('GET');

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @param array $params
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function setSettings(int $id, array $params){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id)
            ->setMethod('PUT')
            ->setData($params);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getEngineVersions(int $id){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id.'/engine-versions/');

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @param array $params
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function setEngineSettings(int $id, array $params){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id.'/engine-settings/')
            ->setMethod('PUT')
            ->setData($params);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @param string $cron_mail
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function setCronEmail(int $id, string $cron_mail)
    {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id.'/set-cron-mail/')
            ->setMethod('PUT')
            ->setData([
                'cron_mail' => $cron_mail,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getSettingPHP(int $id){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id.'/php-directives/');

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @param string $term
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function searchSettingPHP(int $id, string $term){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id.'/php-directives/search/')
            ->setData([
                'term' => $term,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function orderSSL(int $id)
    {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id.'/order-certificate/')
            ->setMethod('PUT');

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function reboot(int $id)
    {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id.'/restart/')
            ->setMethod('PUT');

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function delete(int $id){
        $request = self::$_httpClient
            ->initHttpRequest(self::URL.$id)
            ->setMethod('DELETE');

        return $this->processResponse($request);
    }
}