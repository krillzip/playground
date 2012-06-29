<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NUserAgent
 *
 * @author krillzip
 */
class NUserAgent extends NObject {
    private $_useragent;
    private $_version;
    private $_majorVersion;
    private $_minorVersion;
    private $_browser;

    private $_protocol;
    private $_method;
    private $_referer;
    private $_query;
    private $_ip;
    private $_port;
    private $_ssl;
    private $_uri;

    const OPERA = 'Opera';
    const CHROME = 'Chrome';
    const SAFARI = 'Safari';
    const FIREFOX = 'Firefox';
    const EXPLORER = 'MSIE';

    public function __construct() {
        $this->_useragent = $_SERVER['HTTP_USER_AGENT'];
        $this->probeBrowser($this->_useragent);

        $this->_protocol = $_SERVER['SERVER_PROTOCOL'];
        $this->_method = $_SERVER['REQUEST_METHOD'];
        $this->_query = $_SERVER['QUERY_STRING'];
        $this->_ip = $_SERVER['REMOTE_ADDR'];
        $this->_port = $_SERVER['REMOTE_PORT'];
        $this->_referer = (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : NULL);
        $this->_ssl = !empty($_SERVER['HTTPS']);
        if(strpos($_SERVER['REQUEST_URI'], '?') === false)
            $this->_uri = $_SERVER['REQUEST_URI'];
        else
            $this->_uri = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?'));
    }

    /**
     * Probes the browser useragent for type and version.
     * @param <string> $useragent The useragent to be probed.
     */
    protected function probeBrowser($useragent) {
        $browser = array(
            'Opera'=>'/Opera\/(.*?) /',
            'Chrome'=>'/Chrome\/(.*?) /',
            'Safari'=>'/Version\/(.*?) Safari/',
            'Firefox'=>'/Firefox\/(.*?) /',
            'MSIE'=>'/MSIE (.*?); /',
        );
        $brs = array_keys($browser);
        $recognize = '/('.implode('|', $brs).')/';
        preg_match($recognize, $useragent, $matches);
        array_shift($matches);

        while(count($matches) > 1) {
            $b = array_pop($brs);
            unset($matches[$b]);
        }

        $this->_browser = array_shift($matches);
        preg_match($browser[$this->_browser], $useragent, $matches);
        $this->_version = $matches[1];
        $vers = explode('.', $this->_version);
        $this->_majorVersion = array_shift($vers);
        $this->_minorVersion = array_shift($vers);
    }

    /**
     * returns requesting browsers User Agent.
     * @return <type>
     */
    public function getUseragent() {
        return $this->_useragent;
    }

    /**
     * returns name of the requesting browser.
     * @return <type>
     */
    public function getBrowser() {
        return $this->_browser;
    }

    /**
     *  returns the requesting browsers full version.
     * @return <type>
     */
    public function getVersion() {
        return $this->_version;
    }

    /**
     * returns the requesting browsers major version number.
     * @return <type>
     */
    public function getMajorVersion() {
        return $this->_majorVersion;
    }

    /**
     * returns the requesting browsers minor version number.
     * @return <type>
     */
    public function getMinorVersion() {
        return $this->_minorVersion;
    }

    /**
     * returns the used protocol header for currrent request.
     * @return <type>
     */
    public function getProtocol() {
        return $this->_protocol;
    }

    /**
     * returns the method used for the current request.
     * @return <type>
     */
    public function getMethod() {
        return $this->_method;
    }

    /**
     * returns the query information after the "?" in the url of current request.
     * @return <type>
     */
    public function getQuery() {
        return $this->_query;
    }

    /**
     * returns the IP address of the calling user agent for the current request.
     * @return <type>
     */
    public function getIp() {
        return $this->_ip;
    }

    /**
     * returns the port of the useragent used for the current request.
     * @return <type>
     */
    public function getPort() {
        return $this->_port;
    }

    /**
     * returns the referer fo the current request.
     * @return <type>
     */
    public function getReferer() {
        return $this->_referer;
    }

    /**
     * returns true if HTTPS was used.
     * @return <type>
     */
    public function getSsl() {
        return $this->_ssl;
    }

    /**
     * returns the URI for the current request.
     * @return <type>
     */
    public function getUri() {
        return $this->_uri;
    }
}