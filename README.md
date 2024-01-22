Yii2 client info
================

The component provides a convenient way to retrieve information from the client (user), including the IP address, country, and device. It's very fast thanks to caching.
[Mobile Detect](https://github.com/serbanghita/Mobile-Detect) library is used to determine the type of device. The [Sypex Geo](https://sypexgeo.net/) database is used to determine the country by IP address.

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require pendalf89/yii2-clientinfo
```

or add

```
"pendalf89/yii2-clientinfo": "^1.0.0"
```

to the require section of your `composer.json` file.

Configuration:

```php
'components' => [
    'clientInfo' => 'pendalf89\clientinfo\ClientInfo',
],
```

You also can add DocBlock into `Yii.php` file for IDE autocompleting.

```php
/**
 * Class WebApplication
 * Include only Web application related components here
 *
 * @property pendalf89\clientinfo\ClientInfo $clientInfo
 */
class WebApplication extends yii\web\Application
{
}
```

Usage
------------
It's very easy to use:

```php
$isMobile = Yii::$app->clientInfo->isMobile();
$ip = Yii::$app->clientInfo->getIP();
$country = Yii::$app->clientInfo->getCountry();
$isFinland = Yii::$app->clientInfo->isCountry('FI');
```
