<?php

namespace TalentLMS\Tests;


use Exception;
use PHPUnit\Framework\TestCase;
use TalentLMS\ApiRequestor;
use TalentLMS\TalentLMS;

class BaseTalentLmsTest extends TestCase
{
    var $getUrl     = '/users/id:1';
    var $postUrl    = '/addusertocourse';
    var $postParams = array(
        'user_id'   => 1,
        'course_id' => 130,
        'role'      => "learner",
    );

    public function setUp()
    {
        parent::setUp();
        $this->setApiKeys();
    }

    protected function setApiKeys()
    {
        TalentLMS::setApiKey('API_KEY');
        TalentLMS::setDomain('DOMAIN');
    }

    protected function setWrongApiKey()
    {
        $this->setApiKeys(); //reset
        TalentLMS::setApiKey('asfasadfsflskafjkl');
    }

    protected function setWrongDomain()
    {
        $this->setApiKeys(); //reset
        //setting directly the apiBease and not the setter to make empty the variable as the setter adds extra text
        TalentLMS::$apiBase = null;
    }

    protected function executeGetRequest()
    {
        try {
            return ApiRequestor::request('get', $this->getUrl);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected function executePostRequest()
    {
        try {
            return ApiRequestor::request('post', $this->postUrl, $this->postParams);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function assertIsArray($table){
        return $this->assertTrue(is_array($table));
    }

    public function assertEqualsExceptionMessage(Exception $ex, $expectedMessage){
        return $this->assertEquals($expectedMessage, $ex->getMessage());
    }
}