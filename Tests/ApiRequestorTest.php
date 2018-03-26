<?php

namespace TalentLMS\Tests;

use Exception;
use TalentLMS\ApiRequestor;

class ApiRequestorTest extends BaseTalentLmsTest
{


    public function testGetRequest()
    {
        $response = $this->executeGetRequest();
        $this->assertTrue(is_array($response));
    }

    public function testPostRequest()
    {
        //expecting success communication with the API and receive exception that user already exists
        try {
            $response = ApiRequestor::request('post', $this->postUrl, $this->postParams);
        } catch (Exception $ex) {
            $this->assertEqualsExceptionMessage($ex, "The requested user is already enrolled in this course");
        }
    }

    public function testInvalidApiKey()
    {
        $this->setWrongApiKey();
        try {
            $response = $this->executeGetRequest();
        } catch (Exception $ex) {
            $this->assertEqualsExceptionMessage($ex, "Invalid API Key provided");
        }
    }

    public function testInvalidDomain()
    {
        $this->setWrongDomain();
        try {
            $response = $this->executeGetRequest();
        } catch (Exception $ex) {
            $this->assertEqualsExceptionMessage($ex,
                'No domain provided. (HINT: set your domain using "TalentLMS::setDomain(\'DOMAIN\')").');
        }
    }
}