# Базовое использование

Для начала, вам необходимо реализовать получение Token для обращения к API с помощью API ключа. Как это сделать [читайте
в документации](https://api.netangels.ru/#token-generation). После получения токена, можно приступить к работе с API.


Для начала обращений к API, используется класс c7v\yii_netangels\NetAngels.
```php
use c7v\yii_netangels\NetAngels;

$netAngels = new NetAngels([
    'accessToken' => 'KlALpLnTagsAaeEuucOgjVNVCohN27zstMb8V2GeRQkLwtd5sBjLAaHjVkXgDQqOQ',
]);
```

### Пример создания контейнера в облочном хостинге

```php
use c7v\yii_netangels\NetAngels;
use c7v\yii_netangels\requesters\hosting\Container;

$netAngels = new NetAngels([
    'accessToken' => 'KlALpLnTagsAaeEuucOgjVNVCohN27zstMb8V2GeRQkLwtd5sBjLAaHjVkXgDQqOQ',
]);

$container = $netAngels->getContainerRequester()->create('Тестовый контейнер', 1024, 10240, Container::ENVIRONMENT_CLOUD_HOST, [
    'password' => 'qwerty123456',
    'redis' => 1024,
    'memcache' => 1024,
]);
```

### Пример заказа выпуска нового ssl-сертификата:

```php
use c7v\yii_netangels\NetAngels;
use c7v\yii_netangels\requesters\hosting\Container;

$netAngels = new NetAngels([
    'accessToken' => 'KlALpLnTagsAaeEuucOgjVNVCohN27zstMb8V2GeRQkLwtd5sBjLAaHjVkXgDQqOQ',
]);

$ssl = $netAngels->getSslRequester()->orderingNewCertificate('sokolovsky.dev', [
    'publisher' => 'LeaderSSL', // Издатель ssl-сертификата: LeaderSSL или LetsEncrypt.
    'extension_period' => 1, // Срок действия
]);
```

## Необязательные параметры:

Все не обязательные параметры, передаются в массиве в конце методов: array $config = []

```php
use c7v\yii_netangels\NetAngels;
use c7v\yii_netangels\requesters\hosting\Container;

$netAngels = new NetAngels([
    'accessToken' => 'KlALpLnTagsAaeEuucOgjVNVCohN27zstMb8V2GeRQkLwtd5sBjLAaHjVkXgDQqOQ',
]);
/** @var integer $id_container */
$id_container = 123456;

$site = $netAngels->getSiteRequester()->create($id_container, 'sokolovsky.dev', 'php', 'mysql', [
    'force_https' => true, // Принудительное использование https
    'charset' => 'utf-8', //Кодировка сайта
])
```