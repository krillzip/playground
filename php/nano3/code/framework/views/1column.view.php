<div id="wrapper">
    <div id="page">
        <div id="contentContainer">
            <div id="content" class="clearfix">
                <div id="mainColumn" class="column">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
        <div id="headerContainer">
            <div id="header">
                <?php echo $layout->container('header'); ?>
            </div>
        </div>
        <div id="footerContainer">
            <div id="footer">
                <?php echo $layout->container('footer'); ?>
            </div>
        </div>
    </div>
</div>