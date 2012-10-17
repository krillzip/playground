<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comment
 *
 * @author krillzip
 */
class Comment extends BloggerModel {
    
    public $type = 'comment';

    protected function populateId($id) {
        if (!empty($id)) {
            preg_match_all('/(\d+)/', $id->text, $matches, PREG_PATTERN_ORDER);
            $this->id = $id->text;
            //$this->_primaryKey = $matches[0][2];
            $this->_foreignKey = $matches[0][2];
        }
    }

}
