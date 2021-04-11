<?php

namespace c7v\yii_netangels\requesters;

use c7v\yii_netangels\HttpClient;
use c7v\yii_netangels\HttpClientException;
use c7v\yii_netangels\NetAngelsException;
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
     * @var HttpClient
     */
    protected static $_httpClient;


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
            $content =  Json::decode($response->getContent());

            if ($response->getIsOk()) {
                return $content;
            } else {
                foreach ($content['errors'] as $key => $error){
                    $errors[] = $key.': '.$error[0];
                }
                throw new NetAngelsException(implode(', ', $errors), $response->getStatusCode());
            }
        } catch (HttpClientException $exception) {
            // TODO: Нужно будет доделать.
        }
    }
}