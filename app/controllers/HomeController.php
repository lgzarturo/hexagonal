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
    View::render('greetings', $data);
  }

  public function test()
  {
    Redirect::to('home/greetings');
  }

  public function db_test()
  {
    View::render('index');
  }
}
