<?php

namespace c7v\yii_netangels\requesters\cloud;

use c7v\yii_netangels\requesters\BaseRequester;
use c7v\yii_netangels\requesters\cloud\Vds;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Class Ssh
 * @package c7v\yii_netangels\requesters\cloud
 */
class Ssh extends BaseRequester
{
    /**
     * @param int $id_vm
     * @param array $config
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getList(int $id_vm, array $config = []) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/ssh/')
            ->setMethod('GET')
            ->setData($config);

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param string $key
     * @param array $config
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function addNewKey(int $id_vm, string $key, array $config = []) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/ssh/create/')
            ->setMethod('POST')
            ->setData(ArrayHelper::merge([
                'key' => $key,
            ], $config));

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param int $key_id
     * @param array $config
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function addOldKey(int $id_vm, int $key_id, array $config = []) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/ssh/upload/')
            ->setMethod('POST')
            ->setData([
                'key_id' => $key_id,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param int $key_id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function delete(int $id_vm, int $key_id) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/ssh/' . $key_id)
            ->setMethod('DELETE');

        return $this->processResponse($request);
    }
}