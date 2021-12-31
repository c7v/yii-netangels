<?php

namespace c7v\yii_netangels\requesters\cloud;

use c7v\yii_netangels\requesters\BaseRequester;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Class Vds
 * @package c7v\yii_netangels\requesters\cloud
 */
class Vds extends BaseRequester
{
    const URL = 'cloud/vms/';

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

    /**
     * @param string $tariff
     * @param int $disk_size
     * @param string $image
     * @param array $config
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function create(string $tariff, int $disk_size, string $image, array $config = []) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL)
            ->setMethod('POST')
            ->setData(ArrayHelper::merge([
                'tariff' => $tariff,
                'disk_size' => $disk_size,
                'image' => $image,
            ], $config));

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @param array $config
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function delete(int $id, array $config = []) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $id)
            ->setMethod('DELETE')
            ->setData($config);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function turnOn(int $id) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $id . '/start/')
            ->setMethod('POST');

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function turnOff(int $id) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $id . '/stop/')
            ->setMethod('POST');

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @param boolean $force
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function reload(int $id, bool $force = false) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $id . '/restart/')
            ->setMethod('POST')
            ->setData([
                'force' => $force,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function rescueMode(int $id) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $id . '/rescue-mode/')
            ->setMethod('POST');

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @param string|null $name
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function changeName(int $id, string $name = null) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $id . '/change-name/')
            ->setMethod('POST')
            ->setData([
                'name' => $name,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function createBackup(int $id) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $id . '/backup/')
            ->setMethod('POST');

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getListBackups(int $id) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $id . '/backups/')
            ->setMethod('GET');

        return $this->processResponse($request);
    }

    /**
     * @param int $id
     * @param string $date
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function rollbackBackup(int $id, string $date) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $id . '/backups/' . $date)
            ->setMethod('POST');

        return $this->processResponse($request);
    }

    public function getListFilesInBackup(int $id, string $date) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $id . '/backups/' . $date . '/files/')
            ->setMethod('GET');

        return $this->processResponse($request);
    }

    public function getArchivedFiles(int $id, string $date) {
        $request = self::$_httpClient
            ->initHttpRequest(self::URL . $id . '/backups/' . $date . '/files/')
            ->setMethod('POST');

        return $this->processResponse($request);
    }



}