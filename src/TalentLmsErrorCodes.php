<?php

namespace TalentLMS;


class TalentLmsErrorCodes
{
    const COULD_NOT_CONNECT       = 11000;
    const INVALID_RESPONSE        = 11001;
    const INVALID_API_KEY         = 11002;
    const INVALID_DOMAIN          = 11003;
    const UNSUPPORTED_CURL_METHOD = 11004;
    const CURL_ERROR              = 11005;
    const INVALID_PARAMS          = 11006;

    protected $names = array(
        self::COULD_NOT_CONNECT       => 'Could not connect to host',
        self::INVALID_RESPONSE        => 'Invalid response body from API',
        self::INVALID_API_KEY         => 'No API key provided.',
        self::INVALID_DOMAIN          => 'No domain provided.',
        self::UNSUPPORTED_CURL_METHOD => 'Unsupported method.',
        self::CURL_ERROR              => 'Error communicating with Talent LMS API.',
    );
}