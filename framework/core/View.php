<?php

class View
{

  public static function render($view_name, $data = [])
  {
    $context = to_object($data);
    $controller = defined('CONTROLLER_ERROR') ? CONTROLLER_ERROR : CONTROLLER;
    $view_path = VIEWS . $controller . DS . $view_name . '.php';
    if (!is_file($view_path)) {
      throw new Exception("View '{$view_path}' not found");
    }
    require_once($view_path);
    exit();
  }
}
