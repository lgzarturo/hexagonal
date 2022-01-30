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
    $messages = [
      'Mensaje 1',
      'Mensaje 2',
      'Mensaje 3'
    ];
    Message::set($messages, 'success');
    Message::set('Informar al usuario');

    View::render('greetings', $data);
  }

  public function test()
  {
    echo 'Ejemplo';
    Redirect::to('home/greetings');
  }
}
