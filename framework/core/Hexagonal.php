<?php

class Hexagonal
{
  private $framework = 'Hexagonal Framework';
  private $configPath = 'framework/config/';
  private $version = '1.0.0';
  private $uri = [];
  private $controllerSuffix = 'Controller';
  private $defaultAction = 'index';
  private $notFoundAction = 'not_found';

  function __construct()
  {
    $this->init();
  }

  private function init()
  {
    $this->session();
    $this->config();
    $this->functions();
    $this->autoload();
    $this->dispatch();
  }

  private function load_file($path, $file)
  {
    if (!is_file($path . $file)) {
      die(sprintf('%s - Critical Error: The file %s does not exist', $this->framework, $file));
    }
    require_once($path . $file);
    return;
  }

  private function session()
  {
    if (session_status() == PHP_SESSION_NONE) {
      define('SESSION_STARTED', true);
      define('FRAMEWORK_NAME', $this->framework);
      define('FRAMEWORK_VERSION', $this->version);
      define('VERSION_PHP', phpversion());
      session_start();
    }
    return;
  }

  private function config()
  {
    $this->load_file($this->configPath, 'core.php');
    return;
  }

  private function functions()
  {
    $this->load_file(HELPERS, 'custom.php');
    $this->load_file(HELPERS, 'functions.php');
    return;
  }

  private function autoload()
  {
    $this->load_file(CORE, 'Autoloader.php');
    Autoloader::init();
    return;
  }

  private function handle_uri()
  {
    if (isset($_GET['uri'])) {
      $uri = $_GET['uri'];
      $uri = rtrim($uri, '/');
      $uri = strip_tags($uri);
      $uri = preg_replace('~[^\pL\d/]+~u', '-', $uri);
      $uri = iconv('utf-8', 'us-ascii//TRANSLIT', $uri);
      $uri = preg_replace('~[^-\w/]+~', '', $uri);
      $uri = trim($uri, '-');
      $uri = preg_replace('~-+~', '-', $uri);
      $uri = mb_strtolower($uri, 'UTF-8');
      $uri = filter_var($uri, FILTER_SANITIZE_URL);
      if (empty($uri)) {
        $uri = $this->notFoundAction;
      }
      $this->uri = explode('/', $uri);
      return $this->uri;
    }
  }

  function dispatch()
  {
    $this->handle_uri();
    $currentController = $this->uri[0] ?? HOME_CONTROLLER;
    $currentAction = $this->uri[1] ?? $this->defaultAction;
    $currentAction = str_replace('-', '_', $currentAction);
    $params = array_values(empty($this->uri[2])
      ? []
      : array_slice($this->uri, 2));
    $controllerClass = ucfirst($currentController) . $this->controllerSuffix;
    if (!class_exists($controllerClass)) {
      $currentController = ERROR_CONTROLLER;
      $currentAction = $this->notFoundAction;
      $controllerClass = ucfirst($currentController) . $this->controllerSuffix;
    }
    if (!method_exists($controllerClass, $currentAction)) {
      $currentController = ERROR_CONTROLLER;
      $currentAction = $this->notFoundAction;
      $controllerClass = ucfirst($currentController) . $this->controllerSuffix;
    }
    define('CONTROLLER', $currentController);
    define('METHOD', $currentAction);
    try {
      $controller = new $controllerClass();
      if (empty($params)) {
        $fct = new ReflectionMethod($controllerClass, $currentAction);
        $number_of_params = $fct->getNumberOfRequiredParameters();
        if ($number_of_params > 0) {
          throw new Exception("Method {$currentAction} of controller {$currentController} requires {$number_of_params} parameters");
        }
        call_user_func([$controller, $currentAction]);
      } else {
        call_user_func_array([$controller, $currentAction], $params);
      }
    } catch (Exception $ex) {
      $currentAction = $this->defaultAction;
      $currentController = ERROR_CONTROLLER;
      define('CONTROLLER_ERROR', $currentController);
      $controllerClass = ucfirst($currentController) . $this->controllerSuffix;
      $controller = new $controllerClass;
      call_user_func_array([$controller, $currentAction], [$ex]);
    }
  }

  public static function start()
  {
    return new self;
  }
}
