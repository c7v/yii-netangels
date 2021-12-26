<?php

namespace c7v\yii_netangels\requesters\email;

use c7v\yii_netangels\requesters\BaseRequester;
use yii\helpers\ArrayHelper;

/**
 * Class Cron
 * @package c7v\yii_netangels\requesters\hosting
 */
class MailBoxes extends BaseRequester
{
    const URL = 'mail/mailboxes/';

    /**
     * @param int $domain_id
     * @param int $offset
     * @param int $limit
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function listMailBoxes(int $domain_id, int $offset, int $limit) {
        $request = self::$_httpClient
            ->initHttpRequest('/mail/domains/' . $domain_id . '/mailboxes/')
            ->setMethod('GET')
            ->setData([
                'offset' => $offset,
                'limit' => $limit,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $domain_id
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getById(int $domain_id)
    {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $domain_id);

        return $this->processResponse($request);
    }

    /**
     * @param int $email_id
     * @param string $password
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function setPassword(int $email_id, string $password)
    {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $email_id . '/change-password/')
            ->setMethod('PUT')
            ->setData([
                'password' => $password,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $domain_id
     * @param string $name
     * @param string $password
     * @param array $config
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function create(int $domain_id, string $name, string $password, array $config = [])
    {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL)
            ->setMethod('POST')
            ->setData(ArrayHelper::merge([
                'name' => $name,
                'domain_id' => $domain_id,
                'password' => $password,
            ], $config));

        return $this->processResponse($request);
    }

    /**
     * @param int $email_id
     * @param array $config
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function update(int $email_id, array $config = [])
    {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $email_id)
            ->setMethod('PUT')
            ->setData($config);

        return $this->processResponse($request);
    }

    /**
     * @param int $email_id
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function delete(int $email_id) {
        $request = self::$_httpClient->initHttpRequest(self::URL . $email_id)->setMethod('DELETE');

        return $this->processResponse($request);
    }

    /**
     * @param int $email_id
     * @param string $alias
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function addAlias(int $email_id, string $alias)
    {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $email_id . '/add-alias/')
            ->setMethod('PUT')
            ->setData([
                'alias' => $alias,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $email_id
     * @param string $alias
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function deleteAlias(int $email_id, string $alias) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $email_id . '/delete-alias/')
            ->setMethod('PUT')
            ->setData([
                'alias' => $alias,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $email_id
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function cleanup(int $email_id) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $email_id . '/cleanup/')
            ->setMethod('PUT');

        return $this->processResponse($request);
    }
}