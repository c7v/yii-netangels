<?php

namespace c7v\yii_netangels\requesters\cloud;

use c7v\yii_netangels\requesters\BaseRequester;

/**
 * Class Backups
 * @package c7v\yii_netangels\requesters\cloud
 */
class Backups extends BaseRequester
{

    const URL = 'cloud/backups/';

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getListUser() {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL)
            ->setMethod('GET');

        return $this->processResponse($request);
    }

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getListVm() {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . 'vms/')
            ->setMethod('GET');

        return $this->processResponse($request);
    }
}