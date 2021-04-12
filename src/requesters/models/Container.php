<?php

namespace c7v\yii_netangels\requesters\models;

use c7v\yii_netangels\requesters\hosting\ContainerRequester;
use yii\base\Model;

/**
 * Class Container
 * @package c7v\yii_netangels\requesters\models
 *
 * @property int $id
 * @property string $name
 * @property string $login
 * @property string $password
 * @property string $service_address
 * @property string $service_ip
 * @property int $memory_limit
 * @property int $quota
 * @property int $state
 * @property string $created
 * @property string $updated
 * @property int $environment
 * @property array $virtualhosts
 * @property array $memcache
 * @property array $redis
 * @property bool $is_in_transfer
 */
class Container extends Model
{
    const STATE_ENABLED = 'enabled';
    const STATE_DISABLED_BY_SERVICE = 'dbs';
    const STATE_DISABLED_BY_ADMIN = 'dba';
    const STATE_DISABLED_BY_QUOTA = 'dbq';


    /**
     * @inheritDoc
     */
    public function attributeLabels()
    {
        return [
            // todo:
        ];
    }

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            // todo:
        ];
    }
}