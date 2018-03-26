<?php

namespace TalentLMS\Tests;

use DateTime;
use Exception;
use TalentLMS\Tests\Traits\UserTrait;
use TalentLMS\User;

class UserTest extends BaseTalentLmsTest
{
    use UserTrait;

    public function testSuccessSignUp()
    {
        $result = User::signup($this->getUniqueUserData());
        $this->assertIsArray($result);
        $this->assertTrue(!empty($result['id']));
    }

    public function testSignUpWithWrongEmail()
    {
        $data = $this->getUniqueUserData();
        $data['email'] = 'InvalidEmail';
        try {
            $result = User::signup($data);
        } catch (Exception $ex) {
            $this->assertEqualsExceptionMessage($ex, "InvalidEmail is not a valid email");
        }
    }

    public function testSignUpWithEmptyUsername()
    {
        $data = $this->getUniqueUserData();
        $data['login'] = null;
        try {
            $result = User::signup($data);
        } catch (Exception $ex) {
            $this->assertEqualsExceptionMessage($ex, "Invalid arguments provided");
        }
    }

    public function testSignUpWithEmptyPassword()
    {
        $data = $this->getUniqueUserData();
        $data['password'] = null;
        try {
            $result = User::signup($data);
        } catch (Exception $ex) {
            $this->assertEqualsExceptionMessage($ex, "Invalid arguments provided");
        }
    }

    public function testSignUpWithDuplicateEmail()
    {
        $data = $this->createRandomUser();

        $duplicateData = $this->getUniqueUserData();
        $duplicateData['email'] = $data['email'];
        try {
            $result = User::signup($duplicateData);
        } catch (Exception $ex) {
            $this->assertEqualsExceptionMessage($ex, "A user with the same email address already exists");
        }
    }

    public function testAll()
    {
        $result = User::all();
        $this->assertIsArray($result);
        $firstRaw = $result[0];
        $this->assertTrue(!empty($firstRaw['id']));
    }

    public function testRetrieve(){
        //get the first user from users' list
        $result = User::all();
        $firstRaw = $result[0];
        //execute retrieve to get the same user
        $id = $firstRaw['id'];
        $expectedUser = User::retrieve($id);
        $this->assertIsArray($expectedUser);
        //remove related tables
        unset($expectedUser['courses']);
        unset($expectedUser['branches']);
        unset($expectedUser['groups']);
        unset($expectedUser['certifications']);
        unset($expectedUser['badges']);
        //compare the results
        $this->assertEquals($firstRaw, $expectedUser);
    }

    public function testLogin()
    {
        $result = $this->loginUser();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('user_id', $result);
        $this->assertArrayHasKey('login_key', $result);
    }

    public function testFailLogin()
    {
        $userToLoginParams = array(
            'login'           => 'randomusername',
            'password'        => 'password123',
            'logout_redirect' => 'https://test.domain/logoutlms',
        );
        try {
            $result = User::login($userToLoginParams);
        } catch (Exception $ex) {
            $this->assertEqualsExceptionMessage($ex,
                "Your login or password is incorrect. Please try again, making sure that CAPS LOCK key is off");
        }
    }

    public function testLogout()
    {
        $loggedUser = $this->loginUser();
        $logoutData = array(
            'user_id' => $loggedUser['user_id'],
            'next'    => 'https://test.dummy.com/afterlogoutlms',
        );
        $result = User::logout($logoutData);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('redirect_url', $result);
    }

    public function testDelete()
    {
        $userForDeletion = $this->createRandomUser();
        $deleteData = array('user_id' => $userForDeletion['id']);
        $result = User::delete($deleteData);
        $this->assertIsArray($result);
        $this->assertEquals("Operation completed successfully", $result['message']);
    }
}