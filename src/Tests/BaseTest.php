<?php
require "../../vendor/autoload.php";

use TalentLMS\Course;
use TalentLMS\TalentLMS;
use TalentLMS\User;

TalentLMS::setApiKey('yq2KrTsiCVkuyn9br49fiJ6Ex8aUAR');
TalentLMS::setDomain('easymarkets.talentlms.com');

$users = User::all();

var_dump($users);

try {
    $courses = Course::all();

    foreach ($courses as $course) {
        echo "${course['id']}: ${course['name']}\n${course['description']}\n\n";
        $course_id = $course['id'];
    }
    var_dump($courses);
}
catch (Exception $e) {
    var_dump($e->getCode());
    var_dump($e->getMessage());
}

$user_id = null;

// Get User Details
try {
    $user = User::retrieve(array('email' => 'sam@easymarkets.com'));
    var_dump($user);
    $user_id = $user['id'];
}
catch (Exception $e) {
    var_dump($e->getCode());
    var_dump($e->getMessage());
}

// Enroll User in Course
try {
    $enroll = Course::addUser(array('user_id' => $user_id, 'course_id' => $course_id, 'role' => 'learner'));
    var_dump($enroll);
}
catch (Exception $e) {
    var_dump($e->getCode());
    var_dump($e->getMessage());
}

// Get User Details
try {
    $user = User::retrieve(array('email' => 'sam@easymarkets.com'));
    var_dump($user);
}
catch (Exception $e) {
    var_dump($e->getCode());
    var_dump($e->getMessage());
}

