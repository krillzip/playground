<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NStorage
 *
 * @author krillzip
 */
class NStorage {
    public function cookie($alias) {
        return new NCookieStorageAdapter($alias);
    }

    public function session($alias) {
        return new NSessionStorageAdapter($alias);
    }

    public function registry($alias) {
        return new NFileStorageAdapter($alias, array('path'=>'app.runtime.registry'));
    }

    public function cache($alias) {
    // TODO
    }
} 