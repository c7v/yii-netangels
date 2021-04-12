<?php

namespace c7v\yii_netangels\requesters;

use c7v\yii_netangels\ApiCallException;
use c7v\yii_netangels\HttpClient;
use c7v\yii_netangels\NetAngels;
use yii\base\Model;
use yii\helpers\Json;
use yii\httpclient\Request;

/**
 * Class BaseRequester
 * @package c7v\yii_netangels\requesters
 */
abstract class BaseRequester extends Model
{
    /**
     * @var array
     */
    protected $apiCallErrors = [];

    /**
     * @var HttpClient
     */
    protected static $_httpClient;


    /**
     * @param \c7v\yii_netangels\HttpClient $httpClient
     */
    public static function setHttpClient(HttpClient $httpClient)
    {
        self::$_httpClient = $httpClient;
    }

    /**
     * @param \yii\httpclient\Request $request
     * @return array|null
     * @throws \c7v\yii_netangels\ApiCallException
     * @throws \yii\httpclient\Exception
     */
    protected function processResponse(Request $request)
    {
        $this->apiCallErrors = [];

        $response = $request->send();
        $content = Json::decode($response->getContent());

        if ($response->getIsOk()) {
            return $content;
        } else {
            foreach ($content['errors'] as $key => $errors) {
                $this->apiCallErrors[$key] = $errors;
            }

            throw new ApiCallException(\Yii::t(NetAngels::T_MSG, 'Api call errors occurred.'));
        }
    }

    /**
     * @return array|null
     */
    public function getApiCallErrors()
    {
        return $this->hasApiCallErrors() ? $this->apiCallErrors : null;
    }

    /**
     * @return bool
     */
    public function hasApiCallErrors()
    {
        return !empty($this->apiCallErrors);
    }
}