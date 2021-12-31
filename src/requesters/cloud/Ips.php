<?php

namespace c7v\yii_netangels\requesters\cloud;

use c7v\yii_netangels\requesters\BaseRequester;
use c7v\yii_netangels\requesters\cloud\Vds;
use yii\base\InvalidConfigException;

/**
 * Class Ips
 * @package c7v\yii_netangels\requesters\cloud
 */
class Ips extends BaseRequester
{

    /**
     * @param int $id_vm
     * @param int $version
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function add(int $id_vm, int $version = 4) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/ips/')
            ->setMethod('POST')
            ->setData([
                'version' => $version,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param int $version
     * @param int $bandwidth
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function addProtected(int $id_vm, int $version = 4, int $bandwidth = 10) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/ips/protected/')
            ->setMethod('POST')
            ->setData([
                'version' => $version,
                'bandwidth' => $bandwidth,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param string $ip
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function addReserved(int $id_vm, string $ip) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/ips/reserved/')
            ->setMethod('POST')
            ->setData([
                'ip' => $ip,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param int $bandwidth
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function changeBandwidth(int $id_vm, int $bandwidth = 10) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/change-bandwidth/')
            ->setMethod('POST')
            ->setData([
                'bandwidth' => $bandwidth,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param string $ip
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function delete(int $id_vm, string $ip) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/ips/')
            ->setMethod('DELETE')
            ->setData([
                'ip' => $ip,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @return array
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function disableProtection(int $id_vm) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/disable-protection/')
            ->setMethod('POST');

        return $this->processResponse($request);
    }
}