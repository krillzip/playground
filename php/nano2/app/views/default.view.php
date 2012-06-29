<p>
    <?php echo $content; ?><br />
    <?php
        $bv = NQueryBuilder::select();
        $bv->columns(array('BibleVersesID', 'Book', 'Chapter', 'Verse', 'Text'));
        $bv->from('BibleVerses', 'bv');
        $bv->condition(new NSqlCondition('Book', NSqlCondition::SQL_EQUAL, array(':book')));
        $bv->condition(new NSqlCondition('Chapter', NSqlCondition::SQL_EQUAL, array(':chapter')));

        $bt = NQueryBuilder::select();
        $bt->columns(array('Language', 'Name', 'Copyright', 'License'));
        $bt->from('BibleTranslations', 'bt');
        $bt->condition(new NSqlCondition('Language', NSqlCondition::SQL_EQUAL, array(':lang')));

        $bj = NQueryBuilder::join();
        $bj->join($bt, 'BibleTranslationsID', $bv, 'BibleTranslationsID');
        $bj->join($bt, 'BibleTranslationsID', clone $bv, 'BibleTranslationsID');
        $bj->limit(50, 10);
        echo $bj;
    ?>
</p>