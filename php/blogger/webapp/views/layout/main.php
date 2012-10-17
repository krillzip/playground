<!DOCTYPE html>
<html>
    <head>
        <title>Website title</title>
        <link rel="stylesheet" href="css/reset.css" type="text/css" />
        <link rel="stylesheet" href="css/typography.css" type="text/css" />
        <link rel="stylesheet" href="css/default.css" type="text/css" />
    </head>
    <body>
        <div class="wrapper">
            <header class="main">
                <hgroup class="rounded shadow">
                    <h1>My blog</h1>
                    <h2>Lorem ipsum slogan...</h2>
                </hgroup>
                <nav class="rounded shadow">
                    <ul class="clearfix">
                        <li><a href="">Link 1</a></li>
                        <li><a href="">Link 2</a></li>
                        <li><a href="">Link 3</a></li>
                        <li><a href="">Link 4</a></li>
                        <li><a href="">Link 5</a></li>
                    </ul>
                </nav>
            </header>
            <div class="clearfix">
            <section class="bodyWrapper">
                <?php echo $content; ?>
            </section>
            <aside class="sideWrapper">
                sfsdf
            </aside>
            <aside class="side2Wrapper">
                sfsdf
            </aside>
            </div>
            <footer class="main">
                &copy; 2012 Kristoffer Paulsson. All rights reserved.
            </footer>
        </div>
    </body>
</html>