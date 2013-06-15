<?php
/**
 * google.language.Languages: 
 * 
 * 'AFRIKAANS' : 'af',
 * 'ALBANIAN' : 'sq',
 * 'AMHARIC' : 'am',
 * 'ARABIC' : 'ar',
 * 'ARMENIAN' : 'hy',
 * 'AZERBAIJANI' : 'az',
 * 'BASQUE' : 'eu',
 * 'BELARUSIAN' : 'be',
 * 'BENGALI' : 'bn',
 * 'BIHARI' : 'bh',
 * 'BULGARIAN' : 'bg',
 * 'BURMESE' : 'my',
 * 'CATALAN' : 'ca',
 * 'CHEROKEE' : 'chr',
 * 'CHINESE' : 'zh',
 * 'CHINESE_SIMPLIFIED' : 'zh-CN',
 * 'CHINESE_TRADITIONAL' : 'zh-TW',
 * 'CROATIAN' : 'hr',
 * 'CZECH' : 'cs',
 * 'DANISH' : 'da',
 * 'DHIVEHI' : 'dv',
 * 'DUTCH': 'nl',
 * 'ENGLISH' : 'en',
 * 'ESPERANTO' : 'eo',
 * 'ESTONIAN' : 'et',
 * 'FILIPINO' : 'tl',
 * 'FINNISH' : 'fi',
 * 'FRENCH' : 'fr',
 * 'GALICIAN' : 'gl',
 * 'GEORGIAN' : 'ka',
 * 'GERMAN' : 'de',
 * 'GREEK' : 'el',
 * 'GUARANI' : 'gn',
 * 'GUJARATI' : 'gu',
 * 'HEBREW' : 'iw',
 * 'HINDI' : 'hi',
 * 'HUNGARIAN' : 'hu',
 * 'ICELANDIC' : 'is',
 * 'INDONESIAN' : 'id',
 * 'INUKTITUT' : 'iu',
 * 'ITALIAN' : 'it',
 * 'JAPANESE' : 'ja',
 * 'KANNADA' : 'kn',
 * 'KAZAKH' : 'kk',
 * 'KHMER' : 'km',
 * 'KOREAN' : 'ko',
 * 'KURDISH': 'ku',
 * 'KYRGYZ': 'ky',
 * 'LAOTHIAN': 'lo',
 * 'LATVIAN' : 'lv',
 * 'LITHUANIAN' : 'lt',
 * 'MACEDONIAN' : 'mk',
 * 'MALAY' : 'ms',
 * 'MALAYALAM' : 'ml',
 * 'MALTESE' : 'mt',
 * 'MARATHI' : 'mr',
 * 'MONGOLIAN' : 'mn',
 * 'NEPALI' : 'ne',
 * 'NORWEGIAN' : 'no',
 * 'ORIYA' : 'or',
 * 'PASHTO' : 'ps',
 * 'PERSIAN' : 'fa',
 * 'POLISH' : 'pl',
 * 'PORTUGUESE' : 'pt-PT',
 * 'PUNJABI' : 'pa',
 * 'ROMANIAN' : 'ro',
 * 'RUSSIAN' : 'ru',
 * 'SANSKRIT' : 'sa',
 * 'SERBIAN' : 'sr',
 * 'SINDHI' : 'sd',
 * 'SINHALESE' : 'si',
 * 'SLOVAK' : 'sk',
 * 'SLOVENIAN' : 'sl',
 * 'SPANISH' : 'es',
 * 'SWAHILI' : 'sw',
 * 'SWEDISH' : 'sv',
 * 'TAJIK' : 'tg',
 * 'TAMIL' : 'ta',
 * 'TAGALOG' : 'tl',
 * 'TELUGU' : 'te',
 * 'THAI' : 'th',
 * 'TIBETAN' : 'bo',
 * 'TURKISH' : 'tr',
 * 'UKRAINIAN' : 'uk',
 * 'URDU' : 'ur',
 * 'UZBEK' : 'uz',
 * 'UIGHUR' : 'ug',
 * 'VIETNAMESE' : 'vi',
 * 'UNKNOWN' : '' 
 *
 */


/**
 * 
 * retrive the translation from google.
 * @author roga
 *
 */
class translator
{

	private $google_translate_url = 'http://ajax.googleapis.com/ajax/services/language/translate?'; 

	function __construct() {}

	/**
	 * 
	 * function translate
	 * @param string $text
	 * @param string $src_lang
	 * @param string $dest_lang
	 */
	function translate($text, $src_lang, $dest_lang)
	{	

		$array = array(
					'v' => '1.0',
					'q'=>$text,
					'langpair' => "$src_lang|$dest_lang",
					'format' => 'text'
		);

		$query_string =  $this->google_translate_url . http_build_query($array);
    echo $query_string;
		$response = $this->curl_it($query_string);		
		return $response['responseData']['translatedText'];
	}

	/**
	 * 
	 * implement http connection to an certain url.
	 */
	function curl_it($query_string = NULL)
	{
		$ch = curl_init($query_string);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);		
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);	
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		$response = curl_exec($ch);

		if(curl_exec($ch) === false) echo 'Curl error: ' . curl_error($ch);

		curl_close($ch);

		return json_decode($response, TRUE);
	}
	
	function __destruct() {}
}