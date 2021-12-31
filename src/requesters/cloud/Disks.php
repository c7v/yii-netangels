<?php

namespace c7v\yii_netangels\requesters\cloud;

use c7v\yii_netangels\requesters\BaseRequester;
use c7v\yii_netangels\requesters\cloud\Vds;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Class Disks
 * @package c7v\yii_netangels\requesters\cloud
 */
class Disks extends BaseRequester
{
    const TYPE_DISK_SLOW = 'Slow';
    const TYPE_DISK_NORMAL = 'Normal';
    const TYPE_DISK_FAST = 'Fast';

    /**
     * @param int $id_vm
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getMain(int $id_vm) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/disk/')
            ->setMethod('GET');

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param string $type
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function changeTypeMain(int $id_vm, string $type) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/disk/change-type/')
            ->setMethod('POST')
            ->setData([
                'type' => $type,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param int $volume_id
     * @param string $type
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function changeType(int $id_vm, int $volume_id, string $type) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/volumes/' . $volume_id . '/change-type/')
            ->setMethod('POST')
            ->setData([
                'type' => $type,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param bool $is_backup_enabled
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function changeBackupMain(int $id_vm, bool $is_backup_enabled = true) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/disk/change-backup/')
            ->setMethod('POST')
            ->setData([
                'is_backup_enabled' => $is_backup_enabled,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param int $volume_id
     * @param bool $is_backup_enabled
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function changeBackup(int $id_vm, int $volume_id, bool $is_backup_enabled = true) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/volumes/' . $volume_id . '/change-backup/')
            ->setMethod('POST')
            ->setData([
                'is_backup_enabled' => $is_backup_enabled,
                'volume_id' => $volume_id,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param bool $is_backup_enabled
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function changeNameMain(int $id_vm, string $name) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/disk/change-name/')
            ->setMethod('POST')
            ->setData([
                'name' => $name,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param int $volume_id
     * @param string $name
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function changeName(int $id_vm, int $volume_id, string $name) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/volumes/' . $volume_id . '/change-name/')
            ->setMethod('POST')
            ->setData([
                'name' => $name,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getList(int $id_vm) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/volumes/')
            ->setMethod('GET');

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param string $size
     * @param bool $is_backup_enabled
     * @param array $config
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function add(int $id_vm, string $size, bool $is_backup_enabled = false, array $config = []) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/volumes/')
            ->setMethod('POST')
            ->setData(ArrayHelper::merge([
                'size' => $size,
                'is_backup_enabled' => $is_backup_enabled,
            ], $config));

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param int $volume_id
     * @param int $size
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function resize(int $id_vm, int $volume_id, int $size) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/volumes/' . $volume_id . '/resize/')
            ->setMethod('POST')
            ->setData([
                'size' => $size,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param int $size
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function resizeMain(int $id_vm, int $size) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/disk/resize/')
            ->setMethod('POST')
            ->setData([
                'size' => $size,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param int $volume_id
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function delete(int $id_vm, int $volume_id) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/volumes/' . $volume_id)
            ->setMethod('DELETE');

        return $this->processResponse($request);
    }

    public function getListBackups(int $id_vm, int $volume_id) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/volumes/' . $volume_id . '/backups/')
            ->setMethod('GET');

        return $this->processResponse($request);
    }

    public function rollbackBackup(int $id_vm, int $volume_id, string $date) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/volumes/' . $volume_id . '/backups/' . $date)
            ->setMethod('POST');

        return $this->processResponse($request);
    }

    public function getListFilesInBackup(int $id_vm, int $volume_id, string $date) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/volumes/' . $volume_id . '/backups/' . $date . '/files/')
            ->setMethod('GET');

        return $this->processResponse($request);
    }

    public function getArchivedFiles(int $id_vm, int $volume_id, string $date) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/volumes/' . $volume_id . '/backups/' . $date . '/files/')
            ->setMethod('POST');

        return $this->processResponse($request);
    }
}