<?php

// Setting the error reporting to the strictest level.
error_reporting(E_ALL | E_STRICT);

// Sets standard definitions if not set in the applications /webroot/index.php file.
if(!defined('DS'))
	define('DS', DIRECTORY_SEPARATOR);

if(!defined('APPLICATION_PATH'))
	define('APPLICATION_PATH', dirname(dirname(dirname(__FILE__))).DS.'application');

if(!defined('PLUGINS_PATH'))
	define('PLUGINS_PATH', dirname(dirname(dirname(__FILE__))).DS.'plugins');

if(!defined('SYSTEM_PATH'))
	define('SYSTEM_PATH', dirname(dirname(__FILE__)));

if(!defined('APPLICATION'))
    define('APPLICATION', 'system.app.KWebApplication');

// WEBROOT must be defined in the applications /webroot/index.php file.
if(!defined('WEBROOT'))
	throw new Exception('The WEBROOT definition doesn\'t exist! Declare this definition in your webroot/index.php');

if(!defined('APPURL'))
	throw new Exception('The Web app URL isn\'t defined inin your webroot/index.php');

if(!defined('DEBUGGING'))
	 define('DEBUGGING', false);

if(!defined('PRODUCTION'))
	 define('PRODUCTION', true);

require_once(dirname(__FILE__).DS.'base'.DS.'System.php');

try
{
	System::initialize(APPLICATION);
    $html = System::app()->html;
    $html->view = 'application.views.loremipsum';
    $html->layout = 'application.views.helloworld';

    $select = KDbQuery::select();
    $select->distinct();
    $select->column('BibleVerseID', array('as'=>'id'));
    $select->columns(array(
            'Book'=>array('as'=>'book'),
            'Chapter'=>array('as'=>'chapter'),
            'Verse'=>array('as'=>'verse'),
            'Text'=>array('as'=>'text'),
        ));
    $select->from('bibleverses');
    $select->condition(new KSqlCondition('book', KSqlCondition::K_EQUAL, array('\'_genesis\'')));
    $select->condition(new KSqlCondition('chapter', KSqlCondition::K_EQUAL, array(10)));
    $select->condition(new KSqlCondition('verse', KSqlCondition::K_BETWEEN, array(4, 15)));
    $select->limit(10);

    $message = $select->sql();

    $html->render(get_defined_vars());
}
catch(Exception $e)
{
	echo '<span style="color: red;">Yaiks! an error occured:</span><br />' . $e->getMessage();
	echo $e->getTraceAsString();
}

?>