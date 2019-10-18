<?php

namespace TalentLMS;


class Languages
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
			'pl'      => 'pl',
			'ar'      => 'ar_ae',
			'es'      => 'es',
			'de'      => 'de',
			'ja'      => 'ja'
		);
		return isset($languageMapping[$easymarketsKey])?$languageMapping[$easymarketsKey]:'en';
	}
	
	public static function humanizeLanguage($talentLmsLanguageKey)
	{
		$humanizedLanguages = array(
			'en'    => 'English',
			'zh_cn' => 'Chinese Simplified',
			'pl'    => 'Polish',
			'ar'    => 'Arabic - United Arab Emirates',
			'es'    => 'Spanish',
			'de'    => 'German',
			'ja'    => 'Japanese'
		);
		return isset($humanizedLanguages[$talentLmsLanguageKey])?$humanizedLanguages[$talentLmsLanguageKey]:'English';
	}
}