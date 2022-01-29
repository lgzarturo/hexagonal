<?php

class HomeController
{
  public function index()
  {
    require_once(LAYOUTS . '/main.php');
  }

  public function hello($name)
  {
    require_once(LAYOUTS . '/hello.php');
  }

  public function greetings()
  {
    echo 'Estamos en saludos';
  }
}
