<?php

namespace c7v\yii_netangels\requesters\hosting;

use c7v\yii_netangels\requesters\BaseRequester;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Class Keys
 * @package c7v\yii_netangels\requesters\ssh
 */
class Keys extends BaseRequester
{
    const URL = 'sshkeys/';

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
}