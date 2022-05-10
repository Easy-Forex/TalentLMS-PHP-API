<?php

namespace TalentLMS;

abstract class TalentLMS
{
    public static $apiKey;
    public static $domain;
    public static $apiBase;
    const VERSION = '1.0';

    public static function getApiKey()
    {
        return self::$apiKey;
    }

    public static function setApiKey($apiKey)
    {
        self::$apiKey = $apiKey;
    }

    public static function getDomain()
    {
        return self::$domain;
    }

    public static function setDomain($domain)
    {
        $domain = str_replace('http://', '', $domain);
        $domain = str_replace('https://', '', $domain);
        $domain = str_replace('/', '', $domain);

        self::$domain = $domain;
        self::$apiBase = 'https://' . $domain . '/api/v1';
    }

    public static function getApiBase()
    {
        return self::$apiBase;
    }

    public static function setApiBase($apiBase)
    {
        self::$apiBase = $apiBase;
    }
}
