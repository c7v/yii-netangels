<?php

namespace c7v\yii_netangels\requesters\cloud;

use c7v\yii_netangels\requesters\BaseRequester;

/**
 * Class Access
 * @package c7v\yii_netangels\requesters\cloud
 */
class Access extends BaseRequester
{
    /**
     * @param int $id_vm
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getVnc(int $id_vm) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/vnc/')
            ->setMethod('POST');

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @param string $password
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function changePasswordRoot(int $id_vm, string $password) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/change-password/')
            ->setMethod('POST')
            ->setData([
                'password' => $password,
            ]);

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function turnOnSupportAccess(int $id_vm) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/support-access/')
            ->setMethod('POST');

        return $this->processResponse($request);
    }

    /**
     * @param int $id_vm
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function turnOffSupportAccess(int $id_vm) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/support-access/')
            ->setMethod('DELETE');

        return $this->processResponse($request);
    }
}