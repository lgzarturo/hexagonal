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
    $data = [
      'id' => 1,
      'name' => 'Hexagonal'
    ];
    View::render('greetings', $data);
  }
}
