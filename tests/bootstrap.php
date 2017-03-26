<?php

/**
 * Bootstrap for Mumsys Library tests
 */

if (in_array('root',$_SERVER)) {
    exit('Something belongs to root. Use a different user! Security exit.' . PHP_EOL);
}

ini_set('include_path', '../src/' . PATH_SEPARATOR . get_include_path());

date_default_timezone_set('Europe/Berlin');

setlocale(LC_ALL, 'POSIX');// "C" style

require_once  __DIR__ . '/../src/Mumsys_Loader.php';
spl_autoload_register(array('Mumsys_Loader', 'autoload'));

require_once __DIR__ . '/testconstants.php';
require_once __DIR__ . '/MumsysTestHelper.php';
