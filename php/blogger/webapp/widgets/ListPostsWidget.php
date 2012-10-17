<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ListPostsWidget
 *
 * @author krillzip
 */
class ListPostsWidget extends NWidget{
    
    public $blogId;
    public $offset;
    protected $posts;
    
    public function run(){
        $db = NSys::app()->getComponent('db');
        $this->posts = $db->selectPosts($this->blogId, 100000, $this->offset);
    }
    
    public function __toString() {
        return NView::render(NSys::app()->getViewPath().DS.'widget'.DS.'listPosts.php', array('posts' => $this->posts), true)->flush(true);
    }
}

