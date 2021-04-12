<?php

namespace c7v\yii_netangels\requesters;

use c7v\yii_netangels\HttpClient;
use c7v\yii_netangels\HttpClientException;
use yii\base\Model;
use yii\helpers\Json;
use yii\httpclient\Request;

/**
 * Class BaseRequester
 * @package c7v\yii_netangels\requesters
 */
abstract class BaseRequester extends Model
{
    const ERROR_ATTR_PREFIX = 'error_';

    /**
     * @var array
     */
    public $errorAttributes = [];

    /**
     * @var HttpClient
     */
    protected static $_httpClient;


    /**
     * @param string $name
     * @return mixed
     * @throws \yii\base\UnknownPropertyException
     */
    public function __get($name)
    {
        if (
            false !== strpos($name, self::ERROR_ATTR_PREFIX) &&
            array_key_exists(self::ERROR_ATTR_PREFIX . $name, $this->errorAttributes)
        ) {
            return $this->errorAttributes[self::ERROR_ATTR_PREFIX . $name];
        }

        return parent::__get($name);
    }


    /**
     * @param string $name
     * @param mixed $value
     * @throws \yii\base\UnknownPropertyException
     */
    public function __set($name, $value)
    {
        if (
            false !== strpos($name, self::ERROR_ATTR_PREFIX) &&
            !array_key_exists(self::ERROR_ATTR_PREFIX . $name, $this->errorAttributes)
        ) {
            $this->errorAttributes[self::ERROR_ATTR_PREFIX . $name] = $value;
        }

        parent::__set($name, $value);
    }

    /**
     * @param \c7v\yii_netangels\HttpClient $httpClient
     */
    public static function setHttpClient(HttpClient $httpClient)
    {
        self::$_httpClient = $httpClient;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \yii\httpclient\Exception
     */
    protected function processResponse(Request $request)
    {
        try {
            $response = $request->send();
            $content = Json::decode($response->getContent());

            if ($response->getIsOk()) {
                return $content;
            } else {
                foreach ($content['errors'] as $key => $errors) {
                    $this->addError(self::ERROR_ATTR_PREFIX . $key, $errors);
                }
            }
        } catch (HttpClientException $exception) {
            throw $exception;
        }
    }
}