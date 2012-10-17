<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostWidget
 *
 * @author krillzip
 */
class PostWidget extends NWidget{
    
    public $blogId;
    protected $post;
    
    public function run(){
        $db = NSys::app()->getComponent('db');
        $posts = $db->selectPosts($this->blogId, 1);
        $this->post = $posts[0];
    }
    
    public function __toString() {
        return NView::render(NSys::app()->getViewPath().DS.'widget'.DS.'post.php', array('post' => $this->post), true)->flush(true);
    }
}