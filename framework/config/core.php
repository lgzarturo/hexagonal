<?php

define('IS_LOCAL', in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1')));

define('TIMEZONE', 'America/Cancun');

define('LANGUAGE', 'es');

define('WEB_URI', IS_LOCAL ? dirname($_SERVER['SCRIPT_NAME']) : '/');

define('BASE_PATH', IS_LOCAL ? dirname(__FILE__, 3) : '');

define('APP_SALT', 'HexagonalFramework');

define('URL', IS_LOCAL ? 'http://localhost' . WEB_URI : 'https://hexagonal.local');

define('DS', DIRECTORY_SEPARATOR);

define('ROOT', getcwd() . DS);

define('APP', ROOT . 'app' . DS);

define('CONTROLLERS', APP . 'controllers' . DS);

define('MODELS', APP . 'models' . DS);

define('VIEWS', APP . 'views' . DS);

define('FRAMEWORK', ROOT . 'framework' . DS);

define('CONFIG', FRAMEWORK . 'config' . DS);

define('CORE', FRAMEWORK . 'core' . DS);

define('HELPERS', FRAMEWORK . 'helpers' . DS);

define('PLUGINS', ROOT . 'plugins' . DS);

define('TEMPLATES', ROOT . 'templates' . DS);

define('LAYOUTS', TEMPLATES . 'layouts' . DS);

define('SNIPPETS', TEMPLATES . 'snippets' . DS);

define('RESOURCES', URL . '/resources');

define('FAVICON', RESOURCES . '/favicon');

define('FONTS', RESOURCES . '/fonts');

define('IMAGES', RESOURCES . '/images');

define('SCRIPTS', RESOURCES . '/scripts');

define('STYLES', RESOURCES . '/styles');

define('UPLOADS', RESOURCES . '/uploads');

define('DB_ENGINE', IS_LOCAL ? 'mysql' : '');

define('DB_HOST', IS_LOCAL ? 'localhost' : '');

define('DB_PORT', IS_LOCAL ? '3307' : '');

define('DB_NAME', IS_LOCAL ? 'hexagonal' : '');

define('DB_USER', IS_LOCAL ? 'dev' : '');

define('DB_PASS', IS_LOCAL ? 'MZtnjPMNp#12' : '');

define('DB_CHARSET', IS_LOCAL ? 'utf8' : '');

define('DB_COLLATION', IS_LOCAL ? 'utf8_general_ci' : '');

define('HOME_CONTROLLER', 'home');

define('ERROR_CONTROLLER', 'error');

define('DEFAULT_METHOD', 'index');

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

date_default_timezone_set(TIMEZONE);

error_reporting(E_ALL);

setlocale(LC_ALL, 'en_US.utf8');
