<?php

class Message
{

  private $types = [
    'success',
    'info',
    'warning',
    'danger',
    'quote',
    'light',
    'dark'
  ];
  private $default_type = 'info';
  private $type;
  private $message;

  public static function set($message, $type = null)
  {
    $self = new self();
    $self->message = $message;
    $self->type = $type ?? $self->default_type;
    $self->type = in_array($self->type, $self->types)
      ? $self->type
      : $self->default_type;

    if (is_array($self->message)) {
      foreach ($self->message as $msg) {
        $_SESSION[$self->type][] = $msg;
      }
    } else {
      $_SESSION[$self->type][] = $self->message;
    }
  }

  public static function get()
  {
    $self = new self();
    $messages = [];
    foreach ($self->types as $type) {
      if (isset($_SESSION[$type]) && !empty($_SESSION[$type])) {
        foreach ($_SESSION[$type] as $message) {
          $messages[] = [
            'type' => $type,
            'message' => $message
          ];
        }
        unset($_SESSION[$type]);
      }
    }

    return $messages;
  }
}
