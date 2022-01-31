<?php

DotEnv::load();

// Environment variables

define('DEBUG', getenv('DEBUG') ?? false);

define('TIMEZONE', getenv('TIMEZONE') ?? 'America/Cancun');

define('LANGUAGE', getenv('LANGUAGE') ?? 'es');

define('APP_SALT', getenv('APP_SALT') ?? 'salt');

define('DB_ENGINE', getenv('DB_ENGINE') ?? 'mysql');

define('DB_HOST', getenv('DB_HOST') ?? 'localhost');

define('DB_PORT', getenv('DB_PORT') ?? '3306');

define('DB_NAME', getenv('DB_NAME') ?? 'hexagonal');

define('DB_USER', getenv('DB_USER') ?? 'root');

define('DB_PASS', getenv('DB_PASS') ?? '');

define('DB_CHARSET', getenv('DB_CHARSET') ?? 'utf8');

define('DB_COLLATION', getenv('DB_COLLATION') ?? 'utf8_general_ci');

// Debug mode
if (DEBUG) {
  ini_set('display_errors', 1);

  ini_set('display_startup_errors', 1);

  error_reporting(E_ALL);
}

define('IS_LOCAL', in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1')));

define('WEB_URI', IS_LOCAL ? dirname($_SERVER['SCRIPT_NAME']) : '/');

define('BASE_PATH', IS_LOCAL ? dirname(__FILE__, 3) : '');

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

define('HOME_CONTROLLER', 'home');

define('ERROR_CONTROLLER', 'error');

define('DEFAULT_METHOD', 'index');

date_default_timezone_set(TIMEZONE);

setlocale(LC_ALL, 'es_MX.utf8');
