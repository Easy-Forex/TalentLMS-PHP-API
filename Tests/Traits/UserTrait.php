<?php

namespace TalentLMS\Tests\Traits;


use DateTime;
use TalentLMS\User;

trait UserTrait
{
    protected $passwordOfUser = 'SuperSafePassword';
    protected $userData       = null;
    protected $loginOfUser    = null;

    protected function loginUser()
    {
        //create a random user
        $user = $this->createRandomUser();
        //logged in him
        $userToLoginParams = array(
            'login'           => $user['login'],
            'password'        => $this->passwordOfUser,
            'logout_redirect' => 'https://test.domain/logoutlms',
        );

        $result = User::login($userToLoginParams);
        $ch = curl_init($result['login_key']);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    protected function getUniqueUsername()
    {
        return $username = 'testUser' . (new DateTime())->format('His');
    }

    protected function getUniqueUserData()
    {
        $username = $this->getUniqueUsername();

        return array(
            'first_name' => 'Test First Name',
            'last_name'  => 'Test Last Name',
            'email'      => $username . '@test.com',
            'login'      => $username,
            'password'   => $this->passwordOfUser,
            'user_type'  => 'Testing-Type'
        );
    }

    protected function createRandomUser(){
        $data = $this->getUniqueUserData();
        return User::signup($data);
    }
}