<?php

namespace pendalf89\clientinfo;

use Detection\MobileDetect;
use Yii;
use yii\base\Component;

/**
 * Detects client IP address and device type
 */
class ClientInfo extends Component
{
    /**
     * @var string Used for caching data during the app lifecycle.
     */
    public string $arrayCacheComponent = 'arrayCache';

    /**
     * Detects whether the client device is mobile
     *
     * @return bool
     */
    public function isMobile(): bool
    {
        return Yii::$app->{$this->arrayCacheComponent}->getOrSet(__METHOD__, function () {
            return (new MobileDetect())->isMobile();
        });
    }

    /**
     * Wrapper for getCountry() method for compare country code.
     *
     * @param string $country ISO 3166-1 country ID, for example: "US", "GB", "FI" etc.
     * @return bool
     */
    public function isCountry(string $country): bool
    {
        return $country === $this->getCountry();
    }

    /**
     * Detects client country by IP address.
     *
     * @return string|null ISO 3166-1 country ID, for example: "US", "GB", "FI" etc.
     */
    public function getCountry(): string|null
    {
        return Yii::$app->{$this->arrayCacheComponent}->getOrSet(__METHOD__, function () {
            return (new SxGeo)->getCountry($this->getIP()) ?: null;
        });
    }

    /**
     * Detects real client IP address
     *
     * @return string|null
     */
    public function getIP(): string|null
    {
        return '185.112.82.235';
        return Yii::$app->{$this->arrayCacheComponent}->getOrSet(__METHOD__, function () {
            $headers = [
                'HTTP_CLIENT_IP',
                'HTTP_X_FORWARDED_FOR',
                'HTTP_X_FORWARDED',
                'HTTP_FORWARDED_FOR',
                'HTTP_FORWARDED',
                'REMOTE_ADDR'
            ];

            foreach ($headers as $header) {
                if (isset($_SERVER[$header])) {
                    return $_SERVER[$header];
                }
            }

            return null;
        });
    }
}
