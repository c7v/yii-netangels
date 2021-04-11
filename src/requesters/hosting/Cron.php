<?php

namespace c7v\yii_netangels\requesters\hosting;

use c7v\yii_netangels\requesters\BaseRequester;

/**
 * Class Cron
 * @package c7v\yii_netangels\requesters\hosting
 */
class Cron extends BaseRequester
{
    const URL = 'hosting/crontabs/';

    /**
     * @param int $virtualhost_id
     * @param string $minutes
     * @param string $hours
     * @param string $days
     * @param string $months
     * @param string $weekdays
     * @param string $command
     * @param string|null $comment
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function create(int $virtualhost_id, string $minutes, string $hours, string $days, string $months, string $weekdays, string $command, string $comment = null)
    {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL)
            ->setMethod('POST')
            ->setData([
                'virtualhost_id' => $virtualhost_id,
                'minutes' => $minutes,
                'hours' => $hours,
                'days' => $days,
                'months' => $months,
                'weekdays' => $weekdays,
                'command' => $command,
                'comment' => $comment,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $virtualhost_id
     * @param int|null $offset
     * @param int|null $limit
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getList(int $virtualhost_id, int $offset = null, int $limit = null)
    {
        $request = self::$_httpClient
            ->initHttpRequest(Site::URL . $virtualhost_id . '/crontabs/')
            ->setData([
                'offset' => $offset,
                'limit' => $limit,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getById(int $id)
    {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $id)
            ->setMethod('GET');

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @param array $params
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function update(int $id, array $params)
    {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $id)
            ->setMethod('PUT')
            ->setData($params);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function delete(int $id)
    {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $id)
            ->setMethod('DELETE');

        return $this->processResponse($request);
    }
}