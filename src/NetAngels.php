<?php

namespace c7v\yii_netangels;

use c7v\yii_netangels\requesters\cloud\Access;
use c7v\yii_netangels\requesters\cloud\Backups;
use c7v\yii_netangels\requesters\cloud\Disks;
use c7v\yii_netangels\requesters\cloud\Image;
use c7v\yii_netangels\requesters\cloud\Ips;
use c7v\yii_netangels\requesters\cloud\Lan;
use c7v\yii_netangels\requesters\cloud\Ssh;
use c7v\yii_netangels\requesters\cloud\Tariff;
use c7v\yii_netangels\requesters\cloud\Vds;
use c7v\yii_netangels\requesters\email\MailBoxes;
use c7v\yii_netangels\requesters\email\MailDomains;
use c7v\yii_netangels\requesters\email\MailOther;
use c7v\yii_netangels\requesters\hosting\Container;
use c7v\yii_netangels\requesters\hosting\Cron;
use c7v\yii_netangels\requesters\hosting\DataBase;
use c7v\yii_netangels\requesters\hosting\Site;
use c7v\yii_netangels\requesters\hosting\SshKey;
use c7v\yii_netangels\requesters\ssl\Certificates;
use c7v\yii_netangels\requesters\ssh\Keys;
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
    public function getCronRequester()
    {
        $container = new Cron();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return MailBoxes
     */
    public function getMailBoxesRequester()
    {
        $container = new MailBoxes();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return MailDomains
     */
    public function getMailDomainsRequester()
    {
        $container = new MailDomains();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return MailOther
     */
    public function getMailOtherRequester()
    {
        $container = new MailOther();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return Certificates
     */
    public function getSslRequester()
    {
        $container = new Certificates();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return Keys
     */
    public function getSshRequester()
    {
        $container = new Keys();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return Vds
     */
    public function getVdsRequester()
    {
        $container = new Vds();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return Image
     */
    public function getImageRequester()
    {
        $container = new Image();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return Tariff
     */
    public function getTariffRequester()
    {
        $container = new Tariff();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return Disks
     */
    public function getDiskRequester()
    {
        $container = new Disks();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return Lan
     */
    public function getLanRequester()
    {
        $container = new Lan();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return Ssh
     */
    public function getSshVdsRequester()
    {
        $container = new Ssh();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return Access
     */
    public function getAccessRequester()
    {
        $container = new Access();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return Backups
     */
    public function getBackupsRequester()
    {
        $container = new Backups();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }

    /**
     * @return Ips
     */
    public function getIpsRequester()
    {
        $container = new Ips();
        $container::setHttpClient($this->_httpClient);

        return $container;
    }
}