<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BloggerModel
 *
 * @author krillzip
 */
abstract class BloggerModel extends NComponent{

    const TYPE_BLOG = 'blog';
    const TYPE_POST = 'post';
    const TYPE_COMMENT = 'comment';
    
    public $author = array();
    public $category = array();
    public $content;
    public $contributor = array();
    public $control;
    public $edited;
    public $id;
    public $link = array();
    public $published;
    public $rights;
    public $source;
    public $summary;
    public $text;
    public $title;
    public $updated;
    protected $_primaryKey;
    protected $_foreignKey;
    public $type;

    public function __construct($entry) {
        if( is_a($entry, 'Zend_Gdata_Entry') ){
            $this->populate($entry);
        }elseif(is_array($entry)){
            $this->importFromArray($entry);
        }else{
            throw new Exception('Entry must be array or Zend_Gdata_Entry');
        }
    }
    
    public static function factory(Zend_Gdata_Entry $entry, $type){
        switch($type){
            case BloggerModel::TYPE_BLOG:
                return new Blog($entry);
            case BloggerModel::TYPE_POST:
                return new Post($entry);
            case BloggerModel::TYPE_COMMENT:
                return new Comment($entry);
            default:
                return NULL;
        }
    }

    public function populate(Zend_Gdata_Entry $e) {
        $matches = array();

        /* $authors = $e->author;
          if (!empty($authors)) {
          foreach ($authors as $author) {
          $person = new Person();
          $person->populate($author);
          $this->author[] = $person;
          }
          } */

        $categories = $e->category;
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $this->category[] = $category->term;
            }
        }

        $content = $e->content;
        if (!empty($content)) {
            $this->content = $content->text;
        }

        /* $contributors = $e->contributor;
          if (!empty($contributors)) {
          foreach ($contributors as $contributor) {
          $person = new Person();
          $person->populate($contributor);
          $this->contributor[] = $person;
          }
          } */

        $control = $e->control;
        if (!empty($control)) {
            $this->control = $control->draft->text;
        }

        $edited = $e->edited;
        if (!empty($edited)) {
            $dt = new DateTime($edited->text);
            $this->edited = $dt->format('Y-m-d H:i:s');
        }

        $id = $e->id;
        $this->populateId($id);

        $links = $e->link;
        if (!empty($links)) {
            foreach ($links as $link) {
                if (!key_exists($link->rel, $this->link)) {
                    $this->link[$link->rel] = $link->href;
                }
            }
        }

        $published = $e->published;
        if (!empty($published)) {
            $dt = new DateTime($published->text);
            $this->published = $dt->format('Y-m-d H:i:s');
        }

        $rights = $e->rights;
        if (!empty($rights)) {
            $this->rights = $rights->text;
        }

        // source
        // @TODO

        $summary = $e->summary;
        if (!empty($summary)) {
            $this->summary = $summary->text;
        }

        // text
        // TODO

        $title = $e->title;
        if (!empty($title)) {
            $this->title = $title->text;
        }

        $updated = $e->updated;
        if (!empty($updated)) {
            $dt = new DateTime($updated->text);
            $this->updated = $dt->format('Y-m-d H:i:s');
        }
    }

    protected abstract function populateId($id);

    public function exportToArray() {
        return array(
            'author' => json_encode($this->author),
            'category' => implode(',', $this->category),
            'content' => $this->content,
            'contributor' => json_encode($this->contributor),
            'control' => $this->control,
            'edited' => $this->edited,
            'id' => $this->id,
            'link' => json_encode($this->link),
            'published' => $this->published,
            'rights' => $this->rights,
            'source' => $this->source,
            'summary' => $this->summary,
            'text' => $this->text,
            'title' => $this->title,
            'updated' => $this->updated,
            'primaryKey' => $this->_primaryKey,
            'foreignKey' => $this->_foreignKey,
            'type' => $this->type,
        );
    }

    public function importFromArray(array $data) {
        $data = (object) $data;
        
        $this->author = json_decode($data->author);
        $this->category = empty($data->category) === true ? array() : explode(',', $data->category);
        $this->content = $data->content;
        $this->contributor = json_decode($data->contributor);
        $this->control = $data->control;
        $this->edited = $data->edited;
        $this->id = $data->id;
        $this->link = empty($this->link) === true ? array() : json_decode($this->link);
        $this->published = $data->published;
        $this->rights = $data->rights;
        $this->source = $data->source;
        $this->summary = $data->summary;
        $this->text = $data->text;
        $this->title = $data->title;
        $this->updated = $this->updated;
        $this->_primaryKey = $data->primary_key;
        $this->_foreignKey = $data->foreign_key;
        $this->type = $data->type;
    }
    
    public function getPrimaryKey(){
        return $this->_primaryKey;
    }

}
