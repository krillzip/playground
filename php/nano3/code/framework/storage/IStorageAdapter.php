<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IStorageAdapter
 *
 * @author krillzip
 */
interface IStorageAdapter {
    public function set($key, $value, $expires = null);
    public function get($key);

    public function flush();
    public function all();

    public function exists($key);
    public function delete($key);
}
