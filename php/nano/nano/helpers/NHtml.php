<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NHtml
 * is a helper class that generate xhtml strict tags.
 *
 * @author krillzip
 */

class NHtml {
/**
  * <---- ---- ---- SINGLETON STARTS HERE ---- ---- ---->
  */
    private function __construct()
    {
        $this->xhtml = NFramework::import('nano.helpers.xhtml');
    }
    private static $instance = NULL;
    private function __clone(){throw new Exception();}
    protected static function instance() {
        $class = __CLASS__;
        if(self::$instance == NULL)
        self::$instance = new $class();
        return self::$instance;
    }
/**
  * <---- ---- ---- SINGLETON ENDS HERE ---- ---- ---->
  */
    private $xhtml = array();

    /**
     * Checks if the specified tag is legal strict xhtml.
     * @param <string> $tag
     * @return <boolean>
     */
    protected function legal($tag)
    {
        return array_key_exists($tag, $this->xhtml);
    }

    /**
     * Generate all the attributes for the specified tag, removes illegal attributes
     * according to strict xhtml, adds empty mandatory attributes, and the attributes
     * specified.
     * @todo Write this method
     * @param <string> $tag
     * @param <array> $attr
     */
    protected function attributes($tag, array $attr)
    {
        $mandatory = $this->xhtml[$tag]['_mandatory'];
    }

    /**
     * Generate a single tag or start/end tags if value is specified, and strict xhtml
     * supports that.
     * @param <string> $tag
     * @param <array> $attr
     * @param <string> $value
     */
    public static function tag($tag, array $attr = array(), $value = NULL)
    {

    }

    /**
     *  Generates the start tag that is strict xhtml.
     * @param <string> $tag
     * @param <array> $attr
     */
    public static function beginTag($tag, array $attr = array())
    {

    }

    /**
     * Generates end tag for strict xhtml
     * @param <string> $tag
     */
    public static function endTag($tag)
    {

    }
}

?>