<?php

namespace c7v\yii_netangels;

use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use yii\httpclient\CurlTransport;
use yii\httpclient\Request;
use yii\web\Response;

/**
 * Class HttpClient
 * @package c7v\yii_netangels
 */
class HttpClient extends Client
{
    /**
     * @var string
     */
    private $_accessToken;

    /**
     * @param string $entryUrl
     * @return Request
     * @throws InvalidConfigException
     */
    public function initHttpRequest($entryUrl)
    {
        $client = new Client([
            'transport' => CurlTransport::class,
            'baseUrl' => NetAngels::BASE_API_URL,
        ]);
        return $client->createRequest()
            ->setUrl($entryUrl)
            ->setMethod('GET')
            ->setFormat(Response::FORMAT_JSON)
            ->setOptions([
                'maxRedirects' => 3,
                'followLocation' => true,
                'sslVerifyPeer' => false,
            ])
            ->setHeaders([
                'Authorization' => 'Bearer ' . $this->_accessToken,
            ]);
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
}