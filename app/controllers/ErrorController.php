<?php

class ErrorController extends Controller
{
  public function index($ex)
  {
    View::render('500', ['error' => $ex->getMessage()]);
  }

  public function not_found()
  {
    View::render('404');
  }
}
