<?php

namespace TalentLMS;

class Course extends ApiResource
{

    public static function create($params)
    {
        $class = get_class();
        return self::_scopedCreateCourse($class, $params);
    }

    public static function retrieve($id)
    {
        $class = get_class();
        return self::_scopedRetrieve($class, $id);
    }

    public static function all()
    {
        $class = get_class();
        return self::_scopedAll($class);
    }

    /**
     * List active Courses.
     *
     * @return Array $result
     */
    public static function list() {

        $result = array(0 => 'Not Used');
        $courses = self::all();
        foreach($courses as $course){
            if ($course['status'] == 'active' && $course['hide_from_catalog'] == 0){
                $result['Level '.$course['level']][$course['id']] = $course['name'];
            }
        }

        return ksort($result);
    }

    public static function delete($params)
    {
        $class = get_class();
        return self::_scopedDeleteCourse($class, $params);
    }

    public static function addUser($params)
    {
        $class = get_class();
        return self::_scopedAddUserToCourse($class, $params);
    }

    public static function removeUser($params)
    {
        $class = get_class();
        return self::_scopedRemoveUserFromCourse($class, $params);
    }

    public static function gotoCourse($params)
    {
        $class = get_class();
        return self::_scopedGotoCourse($class, $params);
    }

    public static function buyCourse($params)
    {
        $class = get_class();
        return self::_scopedBuyCourse($class, $params);
    }

    public static function getUserStatus($params)
    {
        $class = get_class();
        return self::_scopedGetUserStatusInCourse($class, $params);
    }

    public static function getCustomCourseFields()
    {
        $class = get_class();
        return self::_scopedGetCustomCourseFields($class);
    }

    public static function getByCustomField($params)
    {
        $class = get_class();
        return self::_scopedGetCoursesByCustomField($class, $params);
    }

    public static function resetUserProgress($params)
    {
        $class = get_class();
        return self::_scopedResetUserProgress($class, $params);
    }
}
