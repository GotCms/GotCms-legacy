<?php
/*
 * Set error reporting to the level to which Es code must comply.
 */
error_reporting(E_ALL | E_STRICT);

/*
 * Determine the root, library, and tests directories of the framework
 * distribution.
 */
$es_root        = realpath(dirname(__DIR__));
$zf_library     = $es_root . '/vendor/ZendFramework/library';
$es_library     = $es_root . '/vendor';
$es_tests       = $es_root . '/tests';

$path = array(
    $es_library,
    $zf_library,
    $es_tests,
    get_include_path(),
);

set_include_path(implode(PATH_SEPARATOR, $path));
/**
 * Setup autoloading
 */

require_once $zf_library . '/Zend/Loader/AutoloaderFactory.php';
$app_config = include $es_root . '/config/application.config.php';
Zend\Loader\AutoloaderFactory::factory(array('Zend\Loader\StandardAutoloader' => $app_config['autoloader']));


/*
 * Load the user-defined test configuration file, if it exists; otherwise, load
 * the default configuration.
 */
if (is_readable($es_tests . DIRECTORY_SEPARATOR . 'TestConfiguration.php')) {
    require_once $es_tests . DIRECTORY_SEPARATOR . 'TestConfiguration.php';
} else {
    require_once $es_tests . DIRECTORY_SEPARATOR . 'TestConfiguration.php.dist';
}

/**
 * Start output buffering, if enabled
 */
if (defined('TESTS_ES_OB_ENABLED') && constant('TESTS_ES_OB_ENABLED')) {
    ob_start();
}
/*
 * Unset global variables that are no longer needed.
 */
unset($es_root, $es_library, $es_tests, $path);
