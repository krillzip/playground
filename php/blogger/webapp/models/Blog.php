<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Blog
 *
 * @author krillzip
 */
class Blog extends BloggerModel {

    public $type = 'blog';

    protected function populateId($id) {
        if (!empty($id)) {
            preg_match_all('/[*.]blog-(\d+)$/', $id->text, $matches, PREG_PATTERN_ORDER);
            $this->id = $id->text;
            $this->_primaryKey = $matches[1][0];
        }
    }

}