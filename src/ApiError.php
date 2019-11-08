<?php

namespace TalentLMS;

use \Exception;

class ApiError extends Exception
{

    public function __construct($message = null, $code = 0, $http_status = null, $http_body = null, $json_body = null)
    {
        parent::__construct($message, $code);
        $this->http_status = $http_status;
        $this->http_body = $http_body;
        $this->json_body = $json_body;
		error_log("Talent LMS error: ".$code." \r\nMessage: ".$message);
    }

    public function getHttpStatus()
    {
        return $this->http_status;
    }

    public function getHttpBody()
    {
        return $this->http_body;
    }

    public function getJsonBody()
    {
        return $this->json_body;
    }
}
