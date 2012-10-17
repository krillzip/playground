<ol>
    <?php
        $router = NSys::app()->getComponent('router');
        foreach($posts as $post): 
    ?>
    <li><article>
        <h2><a href="<?php echo $router->createUrl('default', 'post', array('id' => $post->primaryKey)); ?>"><?php echo $post->title; ?></a></h2>
        <summary><?php echo substr(strip_tags($post->content), 0, 200); ?></summary>
    </article></li>
    <?php endforeach; ?>
</ol>