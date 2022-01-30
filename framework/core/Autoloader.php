<?php

class Autoloader
{

  public static function init()
  {
    spl_autoload_register([__CLASS__, 'get_class']);
  }

  private static function get_class($class_name)
  {
    $paths_to_explore = [
      CONTROLLERS,
      MODELS,
      VIEWS,
      CONFIG,
      CORE,
      HELPERS,
      PLUGINS
    ];
    foreach ($paths_to_explore as $path) {
      $file = $path . DS . $class_name . '.php';
      if (is_file($file)) {
        require_once($file);
        return;
      }
    }
    return;
  }
}
