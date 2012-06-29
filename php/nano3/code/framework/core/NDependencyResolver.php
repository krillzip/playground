<?php

final class NDependencyResolver {
    protected $_nodes = array();

    public function __construct(array $config = array()) {
        foreach($config as $name => $edges) {
            $this->add($name, $edges);
        }
    }

    public function add($name, array $dependencies) {
        $node = new StdClass();
        $node->edges = array_filter(array_values($dependencies));
        $node->name = $name;
        $this->_nodes[] = $node;
    }

    public function resolve() {
        usort($this->_nodes, array('NDependencyResolver','bubble'));
        $sorted = array();
        foreach($this->_nodes as $node) {
            $sorted[] = $node->name;
        }
        return array_reverse($sorted);
    }

    protected static function bubble($a, $b) {
        return in_array($a->name, $b->edges)?1:0;
    }
}