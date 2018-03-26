<?php

namespace TalentLMS\Tests\Traits;


use DateTime;
use TalentLMS\Course;
use TalentLMS\User;

trait CourseTrait
{
    protected function getUniqueCourseName()
    {
        return 'testCourse' . (new DateTime())->format('YmdHis');
    }

    protected function getUniqueCourseData()
    {
        return array('name' => $this->getUniqueCourseName());
    }

    protected function createRandomCourse()
    {
        $data = $this->getUniqueCourseData();
        return Course::create($data);
    }

    protected function getRandomEnrollment()
    {
        $user = $this->createRandomUser();
        $course = $this->createRandomCourse();
        $data = array(
            'user_id'   => $user['id'],
            'course_id' => $course['id'],
            'role'      => 'learner',
        );
        return Course::addUser($data);
    }

    protected function isEnrolled($user_id, $course_id)
    {
        $userStored = User::retrieve($user_id);
        $userCourses = $userStored['courses'];
        $hasConfirmed = false;
        foreach ($userCourses as $courseToCheck) {
            if ($courseToCheck['id'] == $course_id) {
                $hasConfirmed = true;
                break;
            }
        }
        return $hasConfirmed;
    }

}