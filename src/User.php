<?php

namespace TalentLMS;

class User extends ApiResource
{
	/**
	 * Mapping method for the language key between easymarkets and talent lms
	 * Available keys on TalentLMS 
	 * en,es,de,fr,el,it,ru,pl,hu,da,sv,no,et,lt,sr,lv,cs,sl,tr,pt,zh_cn,zh_tw,nl,ja,hy,hr,bs_ba,he,ar_ae,fa_ir,mn,ko,id,th,pt_br,ro,fi
	 * @param $easymarketsKey
	 * @return mixed|null
	 */
	public static function getTalentLmsLanguageKey($easymarketsKey)
	{
		$languageMapping = array(
			'en'      => 'en',
			'zh-hans' => 'zh_cn',
			'pl'      => 'en',
			'ar'      => 'ar_ae',
			'es'      => 'es',
			'de'      => 'de'
		);
		return isset($languageMapping[$easymarketsKey])?$languageMapping[$easymarketsKey]:null;	
	}

    public static function retrieve($params)
    {
        $class = get_class();

        if (!is_array($params)) {    // retrieve by id
            return self::_scopedRetrieve($class, $params);
        } else {    // e.g. retrieve by email address
            return self::_scopedExtendedUserRetrieve($class, $params);
        }
    }

    public static function all()
    {
        $class = get_class();
        return self::_scopedAll($class);
    }

    public static function delete($params)
    {
        $class = get_class();
        return self::_scopedDeleteUser($class, $params);
    }

    public static function login($params)
    {
        $class = get_class();
        return self::_scopedLogin($class, $params);
    }

    public static function logout($params)
    {
        $class = get_class();
        return self::_scopedLogout($class, $params);
    }

    public static function signup($params)
    {
        $class = get_class();
        return self::_scopedSignup($class, $params);
    }

    public static function getCustomRegistrationFields()
    {
        $class = get_class();
        return self::_scopedGetCustomRegistrationFields($class);
    }

    public static function setStatus($params)
    {
        $class = get_class();
        return self::_scopedSetUserStatus($class, $params);
    }

    public static function forgotUsername($params)
    {
        $class = get_class();
        return self::_scopedForgotUsername($class, $params);
    }

    public static function forgotPassword($params)
    {
        $class = get_class();
        return self::_scopedForgotPassword($class, $params);
    }

    public static function edit($params)
    {
        $class = get_class();
        return self::_scopedEditUser($class, $params);
    }

    public static function getByCustomField($params)
    {
        $class = get_class();
        return self::_scopedGetUsersByCustomField($class, $params);
    }
}
