<?php

require_once SYS_PATH . DS . 'NSys.php';

try {
    NSys::initialize();
    NSys::app()->run();
    NSys::finalize();
} catch (Exception $e) {
    echo '<h1>' . $e->getMessage() . ', code: ' . $e->getCode() . '</h1>';
    echo $e->getTraceAsString();
}