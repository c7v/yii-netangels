# Yii NetAngels

[![VK](https://github.com/c7v/c7v/raw/master/src/img/label_vk.svg)](https://vk.com/sokolovsky.artem)

Пакет позволяет работать с услугами хостинг провайдера [NetAngels](https://netangels.ru/?p_ref=u73699) через API.
Документация по API находится на [api.netangels.ru](https://api.netangels.ru), документация по пакету находится
в [docs/guide/README.md](docs/guide/README.md).

По вопросам, предложениям и багам обращайтесь в [обсуждения репозитория](https://github.com/c7v/yii-netangels/discussions).

## Поддержка

Поддержка пакета осуществляется в обсуждениях репозитория либо можете написать на почту artem@sokolovsky.dev.
Техническая поддержка REST API осуществляется хостинг провайдером по почте info@netangels.ru

## Возможности, версии:

Для определения возможностей пакета, обратите внимание на версию пакета.

* Хостинг - с версии `0.0.1`
    * Контейнеры
        * Список контейнеров
        * Создание контейнера
        * Информация о контейнере
        * Обновление контейнера
        * Удаление контейнера
        * Список констант
        * Получить информацию о пользователе
        * Настройки базы данных Redis
        * Удаление базы данных Redis
        * Настройки хранилища Memcached
        * Удаление хранилища Memcached
        * Включение/выключение складывания сессий в redis (Только для сайтов работающих на PHP)
    * Cron
        * Получение списка заданий
        * Добавление нового задания
        * Информация о задании
        * Редактирование существующего задания
        * Удаление задания
    * База данных
        * Изменение пароля аккаунта
        * Список баз данных
        * Создание новой БД
        * Удаление
    * Сайты
        * Настройка почтового ящика для уведомлений Cron
        * Список сайтов в контейнере
        * Список сайтов пользователя
        * Создать новый сайт
        * Создать сайт на основе CMS
        * Информация о сайте
        * Доступные версии технологии сайта
        * Обновить настройки технологии сайта
        * Получение настроек PHP
        * Поиск настроек PHP
        * Изменить настройки сайта
        * Удалить сайт
        * Заказ SSL-сертификата для сайта
        * Перезагрузить сайт
    * SSH ключи
        * Список SSH-ключей
        * Загрузка нового SSH-ключа в контейнер
        * Загрузка существующего SSH-ключа в контейнер
        * Удаление SSH-ключа из контейнера
* SSL - с версии `0.0.5`
    * Получение списка SSL-сертификатов
    * Загрузка нового сертификата.
    * Заказ выпуска нового сертификата.
    * Поиск SSL-сертификатов
    * Получить информацию о сертификате.
    * Обновить информацию об сертификате.
    * Удалить сертификат
    * Скачать сертификат
    * Продлить сертификат
* Почта - с версии `0.1.0`
    * Домены
        * Получение списка почтовых доменов
        * Создание почтового домена
        * Информация о домене
        * Удаление домена
        * Изменение состояния DKIM
        * Изменение квоты домена
    * Ящики
        * Список ящиков домена
        * Создание нового ящика
        * Информация о ящике
        * Изменение почтового ящика
        * Удаление ящика
        * Изменение пароля ящика
        * Добавление адреса пересылки
        * Удаление ящика для пересылки
        * Очистка почтового ящика
    * Прочее
        * Получить информацию о пользователе
        * Обновление параметров платной квоты

## Планы
* К версии `1.0.0` реализовать все возможности [API](https://api.netangels.ru/).
* К версии `6.0.0` отказаться от зависимости [yiisoft/yii2-httpclient](https://github.com/yiisoft/yii2-httpclient)