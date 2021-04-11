<?php

namespace c7v\yii_netangels;

use c7v\yii_netangels\requesters\hosting\Container;
use c7v\yii_netangels\requesters\hosting\Cron;
use c7v\yii_netangels\requesters\hosting\DataBase;
use c7v\yii_netangels\requesters\hosting\Site;
use c7v\yii_netangels\requesters\hosting\SshKey;
use yii\base\Component;

/**
 * Class NetAngels
 * @package c7v\yii_netangels
 */
class NetAngels extends Component
{
    const BASE_API_URL = 'https://api-ms.netangels.ru/api/v1/';

    /**
     * @var string
     */
    private $_accessToken;

    /**
     * @var HttpClient
     */
    private $_httpClient;

    /**
     * NetAngels constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['accessToken'])) {
            $this->setAccessToken($config['accessToken']);
        }
        parent::__construct($config);
        $this->_httpClient = $this->initHttpClient();
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->_accessToken;
    }

    /**
     * @param string $token
     */
    public function setAccessToken(string $token)
    {
        $this->_accessToken = $token;
    }

    /**
     * @return HttpClient
     */
    private function initHttpClient()
    {
        return new HttpClient([
            'baseUrl' => self::BASE_API_URL,
            'accessToken' => $this->getAccessToken(),
        ]);
    }


    /**
     * @return Container
     */
    public function getContainerRequester()
    {
        $container = new Container();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return SshKey
     */
    public function getSshKeyRequester()
    {
        $container = new SshKey();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return DataBase
     */
    public function getDataBaseRequester()
    {
        $container = new DataBase();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return Site
     */
    public function getSiteRequester()
    {
        $container = new Site();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return Cron
     */
    public function getCron()
    {
        $container = new Cron();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }
}