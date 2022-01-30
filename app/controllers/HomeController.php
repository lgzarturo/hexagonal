<?php

class HomeController
{
  public function index()
  {
    View::render('index');
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

  public function test()
  {
    echo 'Ejemplo';
    Redirect::to('home/greetings');
  }
}
