<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ZendGdataHelper
 *
 * @author krillzip
 */
class ZendGdataBloggerSupport extends NApplicationComponent {

    const SERVICE = 'blogger';

    protected $includePath;
    protected $user;
    protected $password;
    protected $blogId;
    protected $gdataClient;

    public function init() {
        $this->includePath = NSys::app()->vendorPath;
        set_include_path(get_include_path() . PATH_SEPARATOR . $this->includePath);
        require_once 'Zend' . DS . 'Loader' . DS . 'Autoloader.php';
        Zend_Loader_Autoloader::getInstance();
    }

    protected function loginClient() {
        $client = Zend_Gdata_ClientLogin::getHttpClient(
                        $this->user, $this->password, ZendGdataBloggerSupport::SERVICE, NULL, Zend_Gdata_ClientLogin::DEFAULT_SOURCE, NULL, NULL, Zend_Gdata_ClientLogin::CLIENTLOGIN_URI, 'GOOGLE'
        );
        $this->gdataClient = new Zend_Gdata($client);
    }

    public function getClient() {
        if (empty($this->gdataClient)) {
            $this->loginClient();
        }
        return $this->gdataClient;
    }

    public function getAllBlogs() {
        $query = new Zend_Gdata_Query('http://www.blogger.com/feeds/default/blogs');
        return $this->getClient()->getFeed($query);
    }

    public function getAllPosts($blogId = NULL, array $category = array()) {
        $blogId = empty($blogId) === true ? $this->blogId : $blogId;
        $query = new Zend_Gdata_Query('http://www.blogger.com/feeds/' . $this->blogId . '/posts/default' . (empty($category) === true ? '' : '/-/' . implode('/', $category)));
        return $this->getClient()->getFeed($query);
    }

    public function getAllComments($blogId = NULL, $postId = NULL) {
        $blogId = empty($blogId) === true ? $this->blogId : $blogId;
        $query = new Zend_Gdata_Query('http://www.blogger.com/feeds/' . $this->blogId . (isset($postId) === true ? '/' . $postId : '') . '/comments/default');
        return $this->getClient()->getFeed($query);
    }

    public function feedToModelArray(Zend_Gdata_Feed $feed, $type) {
        $resultSet = array();

        foreach ($feed->entries as $entry) {
            $resultSet[] = BloggerModel::factory($entry, $type);
        }

        return $resultSet;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setPassword($pass) {
        $this->password = $pass;
    }

    public function setBlogId($blogId) {
        $this->blogId = $blogId;
    }
    
    public function getBlogId(){
        return $this->blogId;
    }

}
