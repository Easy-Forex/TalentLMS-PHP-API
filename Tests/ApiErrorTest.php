<?php
namespace TalentLMS\Tests;

use PHPUnit\Framework\TestCase;
use TalentLMS\ApiError;

class ApiErrorTest extends TestCase
{
    /**
     * @var TalentLMS\ApiError $apiError
     */
    var $apiError = null;
    var $expected = array(
        'message'   =>  'Record with this id not found',
        'http_status' => 404,
        'http_body' => '<span class="error">Record not found</span>',
        'json_body' => "{content:'<span class=\"error\">Record not found</span>'}"
    );

    protected function setUp()
    {
        parent::setUp();
        $this->apiError = new ApiError($this->expected['message'],$this->expected['http_status'],$this->expected['http_body'],$this->expected['json_body']);
    }

    public function testApiErrorConstructor()
    {
        $objApiError = new ApiError("This is a test");
        $this->assertInstanceOf(ApiError::class, $objApiError);
    }

    public function testGetMessage()
    {
        $this->assertEquals($this->expected['message'], $this->apiError->getMessage());
    }

    public function testGetHttpStatus()
    {
        $this->assertEquals($this->expected['http_status'], $this->apiError->getHttpStatus());
    }

    public function testGetHttpBody()
    {
        $this->assertEquals($this->expected['http_body'], $this->apiError->getHttpBody());
    }

    public function testGetJsonBody()
    {
        $this->assertEquals($this->expected['json_body'], $this->apiError->getJsonBody());
    }
}