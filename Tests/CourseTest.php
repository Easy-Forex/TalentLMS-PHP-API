<?php

namespace TalentLMS\Tests;


use Exception;
use TalentLMS\Course;
use TalentLMS\Tests\Traits\CourseTrait;
use TalentLMS\Tests\Traits\UserTrait;
use TalentLMS\User;

class CourseTest extends BaseTalentLmsTest
{
    use UserTrait;
    use CourseTrait;
    public function testCreateNewCourse()
    {
        $data = $this->getUniqueCourseData();
        $expected = $data['name'];
        $result = Course::create($data);
        $this->assertIsArray($result);
        $this->assertEquals($expected, $result['name']);
    }

    public function testRetrieveACourse()
    {
        $expected = $this->createRandomCourse();
        $course = Course::retrieve($expected['id']);
        $this->assertIsArray($course);
        //remove relationships
        unset($course['users']);
        unset($course['units']);
        unset($course['rules']);
        unset($course['prerequisites']);
        $this->assertEquals($expected, $course);
    }

    public function testRetrieveAllCourses()
    {
        $courses = Course::all();
        $this->assertIsArray($courses);
    }

    public function testDeleteCourse(){
        $course = $this->createRandomCourse();
        $courseId = $course['id'];
        $result = Course::delete(array('course_id' => $courseId));
        $this->assertIsArray($result);
        $this->assertEquals("Operation completed successfully", $result['message']);
    }

    public function testEnrollUserToCourse(){
        $result = $this->getRandomEnrollment();
        $this->assertIsArray($result);
        //confirm the enroll by reading the user
        $this->assertTrue($this->isEnrolled($result[0]['user_id'], $result[0]['course_id']));
    }

    public function testEnrollUnknownUserToCourse(){
        $course = $this->createRandomCourse();
        $data = array(
            'user_id'   => PHP_INT_MAX,
            'course_id' => $course['id'],
            'role'      => 'learner',
        );
        try {
            $result = Course::addUser($data);
        }
        catch (Exception $ex){
            $this->assertEqualsExceptionMessage($ex, "The requested user does not exist");
        }
    }

    public function testEnrollUserToUnknownCourse(){
        $user = $this->createRandomUser();
        $data = array(
            'user_id'   => $user['id'],
            'course_id' => PHP_INT_MAX,
            'role'      => 'learner',
        );
        try {
            $result = Course::addUser($data);
        }
        catch (Exception $ex){
            $this->assertEqualsExceptionMessage($ex, "The requested course does not exist");
        }
    }

    public function testUnEnrollUserFromCourse() {
        //enroll first
        sleep(1); //work around for the random user id
        $enrollment = $this->getRandomEnrollment();
        $result = Course::removeUser(array('user_id' => $enrollment[0]['user_id'], 'course_id' => $enrollment[0]['course_id']));
        $this->assertIsArray($result);
        $this->assertTrue(!$this->isEnrolled($result['user_id'], $result['course_id']));
    }

    public function testUnEnrollUnknownUserFromCourse() {
        //enroll first
        $enrollment = $this->getRandomEnrollment();
        try {
            $result = Course::removeUser(array('user_id' => PHP_INT_MAX, 'course_id' => $enrollment[0]['course_id']));
        }
        catch (Exception $ex){
            $this->assertEqualsExceptionMessage($ex, "The requested user does not exist");
        }
    }

    public function testUnEnrollUserFromUnknownCourse() {
        //enroll first
        $enrollment = $this->getRandomEnrollment();
        try {
            $result = Course::removeUser(array('user_id' => $enrollment[0]['user_id'], 'course_id' => PHP_INT_MAX));
        }
        catch (Exception $ex){
            $this->assertEqualsExceptionMessage($ex, "The requested course does not exist");
        }
    }
}