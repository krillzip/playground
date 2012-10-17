<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DatabaseConnection
 *
 * @author krillzip
 */
class DatabaseConnection extends NApplicationComponent {

    const SORT_PUBLISHED = 'published';
    const SORT_EDITED = 'edited';
    const SORT_UPDATED = 'updated';
    const SORT_DIR_ASC = 'ASC';
    const SORT_DIR_DESC = 'DESC';

    protected $dsn;
    protected $password;
    protected $user;
    protected $pdo;

    const SQL_INSERT = 'INSERT INTO `entries`(`primary_key`, `foreign_key`, `type`, `author`, `category`, `content`, `contributor`, `control`, `edited`, `id`, `link`, `published`, `rights`, `source`, `summary`, `text`, `title`, `updated`) VALUES (:primaryKey, :foreignKey, :type, :author, :category, :content, :contributor, :control, :edited, :id, :link, :published, :rights, :source, :summary, :text, :title, :updated)';
    protected $insertPrepared;

    const SQL_SELECT_POSTS = 'SELECT * FROM entries WHERE type = \'post\' AND foreign_key = :blogId ORDER BY published DESC LIMIT :limit OFFSET :offset';
    protected $selectPostsPrepared;

    const SQL_SELECT_COMMENTS = 'SELECT * FROM entries WHERE type = \'comment\' AND foreign_key = :postId ORDER BY published ASC LIMIT :limit OFFSET :offset';
    protected $selectCommentsPrepared;
    
    public function init() {
        $this->pdo = new PDO($this->dsn, $this->user, $this->password);
    }

    public function insertEntries($entries) {
        if (!isset($this->insertPrepared)) {
            $this->insertPrepared = $this->pdo->prepare(DatabaseConnection::SQL_INSERT);
        }

        if (is_a($entries, 'Zend_Gdata_Entry')) {
            $entries = array($entries);
        }

        if (!is_array($entries)) {
            throw new DatabaseConnectionException('Entries not of type Zend_Gdata_Entry or an array thereof.', DatabaseConnectionException::NOT_GDATA_ENTRY);
        }

        $stmt = $this->insertPrepared;
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':contributor', $contributor);
        $stmt->bindParam(':control', $control);
        $stmt->bindParam(':edited', $edited);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':published', $published);
        $stmt->bindParam(':rights', $rights);
        $stmt->bindParam(':source', $source);
        $stmt->bindParam(':summary', $summary);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':updated', $updated);
        $stmt->bindParam(':primaryKey', $primaryKey);
        $stmt->bindParam(':foreignKey', $foreignKey);
        $stmt->bindParam(':type', $type);

        try {
            $this->pdo->beginTransaction();
            foreach ($entries as $entry) {
                extract($entry->exportToArray());
                $stmt->execute();
            }
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw new DatabaseConnectionException('Transaction failed while inserting entries', DatabaseConnectionException::INSERT_ENTRIES_FAILED, $e);
        }
    }

    public function selectPosts($blogId, $limit = 100000, $offset = 0) {
        if (!isset($this->selectPostsPrepared)) {
            $this->selectPostsPrepared = $this->pdo->prepare(DatabaseConnection::SQL_SELECT_POSTS);
        }
        
        $stmt = $this->selectPostsPrepared;
        $stmt->bindParam(':blogId', $blogId, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        
        if(!$stmt->execute()){
            throw new Exception(implode(' | ', $stmt->errorInfo()), $stmt->errorCode());
        }
        
        $resultSet = $stmt->fetchAll();
        $posts = array();
        
        foreach($resultSet as $result){
            $posts[] = new Post($result);
        }
        
        return $posts;
    }

    public function selectComments($postId, $limit = 100000, $offset = 0) {
        if (!isset($this->selectCommentsPrepared)) {
            $this->selectCommentsPrepared = $this->pdo->prepare(DatabaseConnection::SQL_SELECT_COMMENTS);
        }
        
        $stmt = $this->selectCommentsPrepared;
        $stmt->bindParam(':postId', $postId, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        
        if(!$stmt->execute()){
            throw new Exception(implode(' | ', $stmt->errorInfo()), $stmt->errorCode());
        }
        
        $resultSet = $stmt->fetchAll();
        $comments = array();
        
        foreach($resultSet as $result){
            $comments[] = new Comment($result);
        }
        
        return $comments;
    }

    public function setDsn($dsn) {
        $this->dsn = $dsn;
    }

    public function setPassword($pwd) {
        $this->password = $pwd;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getPdo() {
        return $this->pdo;
    }

}

class DatabaseConnectionException extends Exception {

    const NOT_GDATA_ENTRY = 1;
    const INSERT_ENTRIES_FAILED = 2;
    const PREPARED_STATEMENT_FAILED = 3;

}