<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NHttpRequest
 * Has a lot of information of the incoming request.
 *
 * @author krillzip
 */
class NHttpRequest {
    private $_useragent;
    private $_platform;
    private $_version;
    private $_majorVersion;
    private $_minorVersion;
    private $_cssVersion;
    private $_browser;

    private $_protocol;
    private $_method;
    private $_referer;
    private $_query;
    private $_ip;
    private $_port;
    private $_ssl;
    private $_uri;

    public function __construct()
    {
        $this->_useragent = $_SERVER['HTTP_USER_AGENT'];
        $browser = get_browser($this->_useragent, true);
        $this->_browser = $browser['browser'];
        $this->_platform = $browser['platform'];
        $this->_version = $browser['version'];
        $this->_majorVersion = $browser['majorver'];
        $this->_minorVersion = $browser['minorver'];
        $this->_cssVersion = $browser['cssversion'];

        $this->_protocol = $_SERVER['SERVER_PROTOCOL'];
        $this->_method = $_SERVER['REQUEST_METHOD'];
        $this->_query = $_SERVER['QUERY_STRING'];
        $this->_ip = $_SERVER['REMOTE_ADDR'];
        $this->_port = $_SERVER['REMOTE_PORT'];
        $this->_referer = $_SERVER['HTTP_REFERER'];
        $this->_ssl = !empty($_SERVER['HTTPS']);
        $this->_uri = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?'));
    }

    /**
     * returns requesting browsers User Agent.
     * @return <type>
     */
    public function getUseragent()
    {
        return $this->_useragent;
    }

    /**
     * returns name of the requesting browser.
     * @return <type>
     */
    public function getBrowser()
    {
        return $this->_browser;
    }

    /**
     *  returns the platform of the requesting browser.
     * @return <type>
     */
    public function getPlatform()
    {
        return $this->_platform;
    }

    /**
     *  returns the requesting browsers full version.
     * @return <type>
     */
    public function getVersion()
    {
        return $this->_version;
    }

    /**
     * returns the requesting browsers major version number.
     * @return <type>
     */
    public function getMajorVersion()
    {
        return $this->_majorVersion;
    }

    /**
     * returns the requesting browsers minor version number.
     * @return <type>
     */
    public function getMinorVersion()
    {
        return $this->_minorVersion;
    }

    /**
     * returns the probably implemented browsers css version.
     * @return <type>
     */
    public function getCssVersion()
    {
        return $this->_cssVersion;
    }

    /**
     * returns the used protocol header for currrent request.
     * @return <type>
     */
    public function getProtocol()
    {
        return $this->_protocol;
    }

    /**
     * returns the method used for the current request.
     * @return <type>
     */
    public function getMethod()
    {
        return $this->_method;
    }

    /**
     * returns the query information after the "?" in the url of current request.
     * @return <type>
     */
    public function getQuery()
    {
        return $this->_query;
    }

    /**
     * returns the IP address of the calling user agent for the current request.
     * @return <type>
     */
    public function getIp()
    {
        return $this->_ip;
    }

    /**
     * returns the port of the useragent used for the current request.
     * @return <type>
     */
    public function getPort()
    {
        return $this->_port;
    }

    /**
     * returns the referer fo the current request.
     * @return <type>
     */
    public function getReferer()
    {
        return $this->_referer;
    }

    /**
     * returns true if HTTPS was used.
     * @return <type>
     */
    public function getSsl()
    {
        return $this->_ssl;
    }

    /**
     * returns the URI for the current request.
     * @return <type>
     */
    public function getUri()
    {
        return $this->_uri;
    }
}
?>