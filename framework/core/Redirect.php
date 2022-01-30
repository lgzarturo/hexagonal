<?php

class Redirect
{
  private $location;

  public static function to($location)
  {
    $self = new self;
    $self->location = $location;

    if (headers_sent()) {
      echo '<script>window.location.href = "' . URL . DS . $self->location . '"</script>';
      echo '<noscript><meta http-equiv="refresh" content="0;url=' . URL . DS . $self->location . '" /></noscript>';
      die();
    }

    if (strpos($location, 'http') !== false) {
      header('Location: ' . $self->location);
      die();
    }

    header('Location: ' . URL . DS . $self->location);
    die();
  }
}
