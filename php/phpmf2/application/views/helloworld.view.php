<?php System::app()->html->title = 'phpMyFramework'; ?>
<h1>Hello world</h1>

<?php $tabs = KAccordion::start(); ?>
<?php $tab = KViewPane::start($tabs, 'Tab no 1', 'application.views.loremipsum', array('message'=>$message)); ?>
<?php $tab = KViewPane::start($tabs, 'Tab no 2', 'application.views.loremipsum', array('message'=>$message)); ?>
<?php $tab = KViewPane::start($tabs, 'Tab no 3', 'application.views.loremipsum', array('message'=>$message)); ?>
<?php $tabs->flush(); ?>
<?php //var_export(System::app()->dbms->introspect()->introspect('bibletags'));?>