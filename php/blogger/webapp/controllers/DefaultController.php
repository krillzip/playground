<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DefaultController
 *
 * @author krillzip
 */
class DefaultController extends NController {

    public function actionIndex() {
        $blogger = NSys::app()->getComponent('blogger');
        $this->render(NULL, array(
            'postWidgetConfig' => new NConfig(array(
                'blogId' => $blogger->getBlogId(),
            )),
            'listPostsWidgetConfig' => new NConfig(array(
                'blogId' => $blogger->getBlogId(),
                'offset' => 1,
            ))
        ));
    }
    
    public function actionPost(){
        $blogger = NSys::app()->getComponent('blogger');
        $params = (object) $this->context->getParams();
        $this->render(NULL, array(
            'postWidgetConfig' => new NConfig(array(
                'blogId' => $blogger->getBlogId(),
            )),
            'listCommentsWidgetConfig' => new NConfig(array(
                'postId' => $params->id,
                'offset' => 0,
            ))
        ));
    }
    
    public function actionImport(){
        $blogger = NSys::app()->getComponent('blogger');
        $db = NSys::app()->getComponent('db');
        
        $db->insertEntries($blogger->feedToModelArray($blogger->getAllBlogs(), BloggerModel::TYPE_BLOG));
        $db->insertEntries($blogger->feedToModelArray($blogger->getAllPosts(), BloggerModel::TYPE_POST));
        $db->insertEntries($blogger->feedToModelArray($blogger->getAllComments(), BloggerModel::TYPE_COMMENT));
        
    }

}