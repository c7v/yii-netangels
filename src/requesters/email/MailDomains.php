<?php

namespace c7v\yii_netangels\requesters\email;

use c7v\yii_netangels\requesters\BaseRequester;
use yii\helpers\ArrayHelper;

/**
 * Class Cron
 * @package c7v\yii_netangels\requesters\email
 */
class MailDomains extends BaseRequester
{
    const URL = 'mail/domains/';

    /**
     * @param int $offset
     * @param int $limit
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function listDomains(int $offset, int $limit) {
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
     * @param int $name
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function create(int $name) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL)
            ->setMethod('POST')
            ->setData([
                'name' => $name,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $domain_id
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getById(int $domain_id) {
        $request = self::$_httpClient->initHttpRequest(self::URL . $domain_id)->setMethod('GET');

        return $this->processResponse($request);
    }

    public function delete(int $domain_id) {
        $request = self::$_httpClient->initHttpRequest(self::URL . $domain_id)->setMethod('DELETE');

        return $this->processResponse($request);
    }

    /**
     * @param int $domain_id
     * @param bool $dkim
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function updateDkim(int $domain_id, bool $dkim) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $domain_id . '/dkim/')
            ->setMethod('PUT')
            ->setData([
                'dkim' => $dkim
            ]);

        return $this->processResponse($request);
    }

    public function updateQuota(int $domain_id, int $quota) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $domain_id . '/quota/')
            ->setMethod('PUT')
            ->setData([
                'quota' => $quota
            ]);

        return $this->processResponse($request);
    }
}