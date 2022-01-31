<?php

class DotEnv
{
  protected $path;

  public function __construct($path)
  {
    if (!is_file($path)) {
      throw new InvalidArgumentException("DotEnv file '{$path}' not found");
    }
    $this->path = $path;
  }

  public function get_path()
  {
    return $this->path;
  }

  public static function load()
  {
    $self = new self('.env');
    if (!is_readable($self->get_path())) {
      throw new RuntimeException("DotEnv file '{$self->path}' is not readable");
    }
    $lines = file($self->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
      if (strpos(trim($line), '#') === 0) {
        continue;
      }
      list($key, $value) = explode('=', $line, 2);
      $key = trim($key);
      $value = trim($value);
      if (!array_key_exists($key, $_SERVER) && !array_key_exists($key, $_ENV)) {
        putenv(sprintf('%s=%s', $key, $value));
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
      }
    }
  }
}
