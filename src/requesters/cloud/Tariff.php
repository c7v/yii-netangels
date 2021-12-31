<?php

namespace c7v\yii_netangels\requesters\cloud;

use c7v\yii_netangels\requesters\BaseRequester;
use c7v\yii_netangels\requesters\cloud\Vds;

/**
 * Class Tariff
 * @package c7v\yii_netangels\requesters\cloud
 */
class Tariff extends BaseRequester
{
    const TARIFF_START_1 = 'start_1';
    const TARIFF_START_2 = 'start_2';
    const TARIFF_START_3 = 'start_3';
    const TARIFF_START_4 = 'start_4';
    const TARIFF_XL16_BIG = 'xl16_big';
    const TARIFF_XL32_BIG = 'xl32_big';
    const TARIFF_XL64_BIG = 'xl64_big';
    const TARIFF_BITRIX_S = 'bitrix_s';
    const TARIFF_BITRIX_M = 'bitrix_m';
    const TARIFF_BITRIX_L = 'bitrix_l';
    const TARIFF_BITRIX_XL = 'bitrix_xl';
    const TARIFF_BITRIX_XXL = 'bitrix_xxl';
    const TARIFF_TINY = 'tiny';
    const TARIFF_SMALL = 'small';
    const TARIFF_MEDIUM = 'medium';
    const TARIFF_LARGE = 'large';

    public function changeTariff(int $id_vm, string $tariff) {
        $request = self::$_httpClient
            ->initHttpRequest(Vds::URL . $id_vm . '/change-tariff/')
            ->setMethod('POST')
            ->setData([
                'tariff' => $tariff,
            ]);

        return $this->processResponse($request);
    }
}