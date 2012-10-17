<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ListCommentsWidget
 *
 * @author krillzip
 */
class ListCommentsWidget extends NWidget{
    
    public $postId;
    public $offset;
    protected $comments;
    
    public function run(){
        $db = NSys::app()->getComponent('db');
        $this->comments = $db->selectComments($this->postId, 100000, $this->offset);
    }
    
    public function __toString() {
        return NView::render(NSys::app()->getViewPath().DS.'widget'.DS.'listComments.php', array('comments' => $this->comments), true)->flush(true);
    }
}


