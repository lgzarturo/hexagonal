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
    $user = new UserModel();
    $user->id = 9;
    $user->name = 'Hexagonal_updated';
    $user->email = 'hexa_updated@gmail.com';
    $user->username = 'hexa_updated';
    $user->password = '123456';
    $count = $user->update();
    echo 'Registros actualizados: ' . $count;
    View::render('index');
  }
}
