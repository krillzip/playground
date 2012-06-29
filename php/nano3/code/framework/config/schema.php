<?php

return array(
'NCacheModel'=>array(
'table'=>'Cache',
'props'=>array(
'id'=>array('id', 'int', array('pk'=>true, 'autoIncrement'=>true)),
'namespace'=>array('Namespace', 'varchar'),
'key'=>array('Key', 'varchar'),
'value'=>array('Value', 'varchar'),
'expires'=>array('Expires', 'datetime'),
),
),
);