<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php if(!empty($language)) echo $language; else 'en'; ?>" lang="<?php if(!empty($language)) echo $language; else 'en'; ?>" dir="<?php if(!empty($direction)) echo $direction; else 'ltr'; ?>">
    <head>
        <title><?php if(!empty($title)) echo $title; else 'Untitled document'; ?></title>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta http-equiv="Cache-Control" content="no-cache" />
        <?php if(!empty($favicon)): ?><link rel="Shortcut Icon" href="<? echo $favicon->href; ?>" type="<?php if(empty($favicon->mime)) echo 'image/x-icon'; else echo $favicon->mime;?>" />
        <?php endif; ?><?php if(!empty($title)): ?><meta name="Title" content="<?php echo $title; ?>" />
        <?php endif; ?><?php if(!empty($meta->author)): ?><meta name="Author" content="<?php echo $meta->author; ?>" />
        <?php endif; ?><?php if(!empty($meta->subject)): ?><meta name="Subject" content="<?php echo $meta->subject; ?>" />
        <?php endif; ?><?php if(!empty($meta->description)): ?><meta name="Description" content="<?php echo $meta->description; ?>" />
        <?php endif; ?><?php if(!empty($meta->keywords)): ?><meta name="Keywords" content="<?php if(is_string($meta->keywords)) echo $meta->keywords; elseif(is_array($meta->keywords)) echo implode(' ', $meta->keywords); ?>" />
        <?php endif; ?><?php if(!empty($meta->generator)): ?><meta name="Generator" content="<?php echo $meta->generator; ?>" />
        <?php endif; ?><?php if(!empty($language)): ?><meta name="Language" content="<?php echo $language; ?>" />
        <?php endif; ?><?php if(!empty($meta->expires)): ?><meta name="Expires" content="<?php echo $meta->expires; ?>" />
        <?php endif; ?><?php if(!empty($meta->abstract)): ?><meta name="Abstract" content="<?php echo $meta->abstract; ?>" />
        <?php endif; ?><?php if(!empty($meta->copyright)): ?><meta name="Copyright" content="<?php echo $meta->copyright; ?>" />
        <?php endif; ?><?php if(!empty($meta->designer)): ?><meta name="Designer" content="<?php echo $meta->designer; ?>" />
        <?php endif; ?><?php if(!empty($meta->publisher)): ?><meta name="Publisher" content="<?php echo $meta->publisher; ?>" />
        <?php endif; ?><?php if(!empty($meta->distribution)): ?><meta name="Distribution" content="<?php echo $meta->distribution; ?>" />
        <?php endif; ?><?php if(!empty($meta->robots)): ?><meta name="Robots" content="<?php echo $meta->robots; ?>" />
        <?php endif; ?><?php if(!empty($base)): ?><base href="<?php echo $base; ?>" />
        <?php endif; ?><?php foreach($assets->rss as $_rss): ?>
        <link rel="alternate" href="<?php echo $_rss->href; ?>" type="application/rss+xml" title="<?php if(empty($_rss->title)) echo 'Untitled RSS'; else echo $_rss->title;?>" />
        <?php endforeach; ?><?php foreach($assets->css as $_css): ?>
        <link rel="stylesheet" href="<?php echo $_css->href; ?>" type="text/css" media="<?php if(empty($_css->media)) echo 'all'; else echo $_css->media;?>" />
        <?php endforeach; ?><?php foreach($assets->js as $_js): ?>
        <script src="<?php echo $_js->src; ?>" type="text/javascript"></script>
        <?php endforeach; ?>
    </head>
    <body>
        <?php echo $content; ?>
    </body>
</html>