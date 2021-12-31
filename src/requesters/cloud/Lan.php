<?php

namespace c7v\yii_netangels\requesters\cloud;

use c7v\yii_netangels\requesters\BaseRequester;
use c7v\yii_netangels\requesters\cloud\Vds;

/**
 * Class Lan
 * @package c7v\yii_netangels\requesters\cloud
 */
class Lan extends BaseRequester
{
    /**
     * @param int $id_vm
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function add(int $id_vm) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/lan/')
            ->setMethod('POST');

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function delete(int $id_vm) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/lan/')
            ->setMethod('DELETE');

        return $this->processResponse($request);
    }
}