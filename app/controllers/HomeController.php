<?php

class HomeController
{
  public function index()
  {
    echo 'Estamos en index';
  }

  public function hola($nombre)
  {
    echo 'Estamos en hola ' . $nombre;
  }

  public function saludos()
  {
    echo 'Estamos en saludos';
  }
}
