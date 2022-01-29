<?php

class Hexagonal
{
  private $framework = 'Hexagonal Framework';
  private $configPath = 'framework/config/';
  private $version = '1.0.0';
  private $uri = [];

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

  private function loadFile($path, $file)
  {
    if (!is_file($path . $file)) {
      die(sprintf('%s - Critical Error: The file %s does not exist', $this->framework, $file));
    }
    require_once($path . $file);
    return;
  }

  private function session()
  {
    if (!session_start()) {
      session_start();
    }
    return;
  }

  private function config()
  {
    $this->loadFile($this->configPath, 'core.php');
    return;
  }

  private function functions()
  {
    $this->loadFile(HELPERS, 'custom.php');
    $this->loadFile(HELPERS, 'functions.php');
    return;
  }

  private function autoload()
  {
    $this->loadFile(CORE, 'Database.php');
    $this->loadFile(CORE, 'Model.php');
    $this->loadFile(CORE, 'Controller.php');
    $this->loadFile(CONTROLLERS, HOME_CONTROLLER . 'Controller.php');
    $this->loadFile(CONTROLLERS, ERROR_CONTROLLER . 'Controller.php');
    return;
  }

  private function handleUri()
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
        $uri = '404';
      }
      $this->uri = explode('/', $uri);
      return $this->uri;
    }
  }

  function dispatch()
  {
    $this->handleUri();
    $currentController = $this->uri[0] ?? HOME_CONTROLLER;
    $currentAction = $this->uri[1] ?? 'index';
    $currentAction = str_replace('-', '_', $currentAction);
    $currentController = ucfirst($currentController) . 'Controller';
    $params = array_values(empty($this->uri[2]) ? [] : array_slice($this->uri, 2));
    if (!class_exists($currentController)) {
      $currentController = ERROR_CONTROLLER . 'Controller';
      $currentAction = 'not_found';
    }

    if (!method_exists($currentController, $currentAction)) {
      $currentController = ERROR_CONTROLLER . 'Controller';
      $currentAction = 'not_found';
    }

    try {
      //TODO manejar los errores si el método requiere parámetros y no los recibe.
      $controller = new $currentController();
      if (empty($params)) {
        is_callable([$controller, $currentAction]) ? $controller->$currentAction() : $controller->index();
        //call_user_func([$controller, $currentAction]);
      } else {
        call_user_func_array([$controller, $currentAction], $params);
      }
    } catch (Exception $ex) {
      $currentAction = 'index';
      $currentController = ERROR_CONTROLLER . 'Controller';
      $controller = new $currentController;
      $controller->$currentAction();
    }
  }
}
