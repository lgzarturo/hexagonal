<?php

class ErrorController
{
  public function index($ex)
  {
    echo "Error general del servidor";
    if (IS_LOCAL) {
      echo "<pre>";
      echo $ex->getMessage();
      echo "</pre>";
    }
  }

  public function not_found()
  {
    echo "Error 404";
  }
}
