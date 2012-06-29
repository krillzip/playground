<div class="kTabContainer" id="kTab<?php echo $id; ?>">
    <ul class="selfClear"><?php $c = 0; foreach($panes as $tab): ?>
    <li class="kTabFlap" id="kTab<?php echo $id; ?>Flap<?php echo $c; ?>">
    <a href="#" class="<?php echo ($c == 0) ? 'active': ''; ?>"><?php echo $tab->name; ?></a>
    </li>
<?php $c++; endforeach; ?></ul>
<?php $c = 0; foreach($panes as $tab): ?><div id="kTab<?php echo $id; ?>Pane<?php echo $c; ?>" class="kTabPane" style="<?php echo ($c == 0) ? 'display: block;': 'display: none;'; ?>">
    <?php echo $tab->content; ?>
</div><?php $c++; endforeach; ?>
</div>