<?php

class HomeController extends Controller
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

  public function db_test()
  {
    print_r($_SESSION);
    $token = "846e9d23854273e70b0f791fa35bc372b30bf41ccb7cea627346d031931435b3";
    if (Security::csrf_validate_token($token)) {
      echo 'Token valido';
    } else {
      echo 'Error al validar el token';
    }
    View::render('index');
  }
}
