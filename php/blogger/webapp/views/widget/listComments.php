<ol>
    <?php
        $router = NSys::app()->getComponent('router');
        foreach($comments as $comment): 
    ?>
    <li><article>
        <h3><?php echo $post->title; ?></h3>
        <summary><?php echo strip_tags($post->content); ?></summary>
    </article></li>
    <?php endforeach; ?>
</ol>