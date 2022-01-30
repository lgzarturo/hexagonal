<?php

class Security
{
  private $expiration_time = 60 * 5;
  private $csrf_token_length = 32;
  private $csrf_token_name = 'csrf_token';
  private $csrf_token_value = '';
  private $csrf_token_expire;

  public function __construct()
  {
    //unset($_SESSION[$this->csrf_token_name]);
    if (!isset($_SESSION[$this->csrf_token_name])) {
      $this->csrf_generate_token();
      $_SESSION[$this->csrf_token_name] = [
        'token' => $this->csrf_token_value,
        'expire' => $this->csrf_token_expire
      ];
      return $this;
    }
    $this->csrf_token_value = $_SESSION[$this->csrf_token_name]['token'];
    $this->csrf_token_expire = $_SESSION[$this->csrf_token_name]['expire'];
    return $this;
  }

  private function csrf_generate_token()
  {
    if (function_exists('bin2hex')) {
      $this->csrf_token_value = bin2hex(openssl_random_pseudo_bytes($this->csrf_token_length));
    } elseif (function_exists('random_bytes')) {
      $this->csrf_token_value = random_bytes(openssl_random_pseudo_bytes($this->csrf_token_length));
    }
    $this->csrf_token_expire = time() + $this->expiration_time;
    //setcookie($this->csrf_token_name, $this->csrf_token_value, $this->csrf_token_expire, '/');
    return $this;
  }

  public static function csrf_validate_token($token, $validate_expires = true)
  {
    $self = new self();
    if ($validate_expires && time() > $self->get_expiration()) {
      return false;
    }

    if ($token !== $self->get_token()) {
      return false;
    }
    return true;
  }

  public function get_expiration()
  {
    return $this->csrf_token_expire;
  }

  public function get_token()
  {
    return $this->csrf_token_value;
  }
}
