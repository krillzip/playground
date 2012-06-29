<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Language
 *
 * @author krillzip
 */
class Language {
/**
 * <---- ---- ---- SINGLETON STARTS HERE ---- ---- ---->
 */
    private static $_instance = NULL;
    private function __clone() {throw new Exception();}
    protected static function instance() {
        $class = __CLASS__;
        if(self::$_instance == NULL)
            self::$_instance = new $class();
        return self::$_instance;
    }
    /**
     * <---- ---- ---- SINGLETON ENDS HERE ---- ---- ---->
     */
    const AFAR = 'aa';
    const ABKHAZIAN = 'ab';
    const AFRIKAANS = 'af';
    const AMHARIC = 'am';
    const ARABIC = 'ar';
    const ASSAMESE = 'as';
    const AYMARA = 'ay';
    const AZERBAIJANI = 'az';
    const BASHKIR = 'ba';
    const BYELORUSSIAN = 'be';
    const BULGARIAN = 'bg';
    const BIHARI = 'bh';
    const BISLAMA = 'bi';
    const BENGALI = 'bn';
    const TIBETAN = 'bo';
    const BRETON = 'br';
    const CATALAN = 'ca';
    const CORSICAN = 'co';
    const CZECH = 'cs';
    const WELSH = 'cy';
    const DANISH = 'da';
    const GERMAN = 'de';
    const BHUTANI = 'dz';
    const GREEK = 'el';
    const ENGLISH = 'en';
    const ESPERANTO = 'eo';
    const SPANISH = 'es';
    const ESTONIAN = 'et';
    const BASQUE = 'eu';
    const PERSIAN = 'fa';
    const FINNISH = 'fi';
    const FIJI = 'fj';
    const FAEROESE = 'fo';
    const FRENCH = 'fr';
    const FRISIAN = 'fy';
    const ISIRH = 'ga';
    const GAELIC = 'gd';
    const GALICIAN = 'gl';
    const GUARANI = 'gn';
    const GUJARATI = 'gu';
    const HAUSA = 'ha';
    const HINDI = 'hi';
    const CROATIAN = 'hr';
    const HUNGARIAN = 'hu';
    const ARMENIAN = 'hy';
    const INTERLINGUA = 'ia';
    const INTERLINGUE = 'ie';
    const INUPIAK = 'ik';
    const INDONESIAN = 'in';
    const ICELANDIC = 'is';
    const ITALIAN = 'it';
    const HEBREW = 'iw';
    const JAPANESE = 'ja';
    const YIDDISH = 'ji';
    const JAVANESE = 'jw';
    const GEORGIAN = 'ka';
    const KAZAKH = 'kk';
    const GREENLANDIC = 'kl';
    const CAMBODIAN = 'km';
    const KANNADA = 'kn';
    const KOREAN = 'ko';
    const KASHMIRI = 'ks';
    const KURDISH = 'ku';
    const KIRGHIZ = 'ky';
    const LATIN = 'la';
    const LINGALA = 'ln';
    const LAOTHIAN = 'lo';
    const LITHUANIAN = 'lt';
    const LATVIAN = 'lv';
    const MALAGASY = 'mg';
    const MAORI = 'mt';
    const MACEDONIAN = 'mk';
    const MALAYALAM = 'ml';
    const MONGOLIAN = 'mn';
    const MOLDAVIAN = 'mo';
    const MARATHI = 'mr';
    const MALAY = 'ms';
    const MALTESE = 'mt';
    const BURMESE = 'my';
    const NAURU = 'na';
    const NEPALI = 'ne';
    const DUTCH = 'nl';
    const NORWEGIAN = 'no';
    const OCCITAN = 'oc';
    const OROMO = 'om';
    const ORIYA = 'or';
    const PUNJABI = 'pa';
    const POLISH = 'pl';
    const PASHTO = 'ps';
    const PORTUGUESE = 'pt';
    const QUECHUA = 'qu';
    const RHAETO_ROMANCE = 'rm';
    const KIRUNDI = 'rn';
    const ROMANIAN = 'ro';
    const RUSSIAN = 'ru';
    const KINYARWANDA = 'rw';
    const SANSKRIT = 'sa';
    const SINDHI = 'sd';
    const SANGRO = 'sg';
    const SERBO_CROATIAN = 'sh';
    const SINGHALESE = 'si';
    const SLOVAK = 'sk';
    const SLOVENIAN = 'sl';
    const SAMOAN = 'sm';
    const SHONA = 'sn';
    const SOMALI = 'so';
    const ALBANIAN = 'sq';
    const SERBIAN = 'sr';
    const SISWATI = 'ss';
    const SESOTHO = 'st';
    const SUDANESE = 'su';
    const SWEDISH = 'sv';
    const SWAHILI = 'sw';
    const TAMIL = 'ta';
    const TEGULU = 'te';
    const TAJIK = 'tg';
    const THAI = 'th';
    const TIGRINYA = 'ti';
    const TURKMEN = 'tk';
    const TAGALOG = 'tl';
    const SETSWANA = 'tn';
    const TONGA = 'to';
    const TURKISH = 'tr';
    const TSONGA = 'ts';
    const TATAR = 'tt';
    const TWI = 'tw';
    const UKRAINIAN = 'uk';
    const URDU = 'ur';
    const UZBEK = 'uz';
    const VIETNAMESE = 'vi';
    const VOLAPUK = 'vo';
    const WOLOF = 'wo';
    const XHOSA = 'xh';
    const YORUBA = 'yo';
    const CHINESE = 'zh';
    const ZULU = 'zu';

    protected $_langPath;
    protected $_defaultLanguage;
    protected $_currentLanguage;
    protected $_messages;

    private function __construct() {
        if(class_exists('Environment')) {
            $env = Environment::instance();
            $this->_currentLanguage = $env->languageCurrent;
            $this->_defaultLanguage = $env->languageDefault;
            $this->_langPath = $env->languageFolder;
            ob_start();
            $this->_messages = include ($this->_langPath.DIRECTORY_SEPARATOR.
                $this->_currentLanguage.DIRECTORY_SEPARATOR.$env->messagefile);
            ob_end_clean();
            if(!is_array($this->_messages))
                $this->_messages = array();
        }
        else {
            $this->_currentLanguage = self::ENGLISH;
            $this->_defaultLanguage = self::ENGLISH;
            $this->_langPath = dirname(__FILE__);
            $this->_messages = array();
        }
    }

    public static function text($path) {
        $instance = self::instance();
        return file_get_contents(
        $instance->_langPath.DIRECTORY_SEPARATOR.
            $instance->_currentLanguage.DIRECTORY_SEPARATOR.
            $path
        );
    }

    public static function message($m) {
        $instance = self::instance();
        return $instance->_messages[$m];
    }
}
?>