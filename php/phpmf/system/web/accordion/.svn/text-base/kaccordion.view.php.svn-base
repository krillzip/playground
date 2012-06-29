<ul class="kAccordionContainer" id="kAccordion<?php echo $id; ?>">
<?php $c = 0; foreach($panes as $tab): ?>
    <li class="kAccordionFlap" id="kAccordion<?php echo $id; ?>Flap<?php echo $c; ?>">
        <a href="#" class="<?php echo ($c == 0) ? 'active': ''; ?>"><?php echo $tab->name; ?></a>
        <div id="kAccordion<?php echo $id; ?>Pane<?php echo $c; ?>" class="kAccordionPane" style="display: <?php echo ($c != 0) ? 'none' : 'block'; ?>;">
            <?php echo $tab->content; ?>
        </div>
    </li>
<?php $c++; endforeach; ?>
</ul>