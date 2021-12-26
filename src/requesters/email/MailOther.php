<?php

namespace c7v\yii_netangels\requesters\email;

use c7v\yii_netangels\requesters\BaseRequester;
use yii\helpers\ArrayHelper;

/**
 * Class Cron
 * @package c7v\yii_netangels\requesters\email
 */
class MailOther extends BaseRequester
{
    const URL = 'mail/';

    /**
     * @param int $offset
     * @param int $limit
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getUserInformation(int $offset, int $limit) {
        $request = self::$_httpClient->initHttpRequest(self::URL)->setMethod('GET');

        return $this->processResponse($request);
    }

    public function updatePaidQuota(bool $paid_quota_enabled, int $paid_quota) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL)
            ->setMethod('PUT')
            ->setData([
                'paid_quota_enabled' => $paid_quota_enabled,
                'paid_quota' => $paid_quota,
            ]);

        return $this->processResponse($request);
    }
}