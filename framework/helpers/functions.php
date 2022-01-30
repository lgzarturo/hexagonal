<?php

function to_object($array)
{
  return json_decode(json_encode($array));
}

function get_alerts($class = 'alert', $closable = true, $icon = 'alert')
{
  $messages = Message::get();
  if (empty($messages)) {
    return;
  }
  $html = '';
  foreach ($messages as $message) {
    $html .= "<div class='$class alert-$message[type]' role='alert'>";
    $html .= $message['message'];
    $html .= '</div>';
  }
  return $html;
}


if (!function_exists('here')) {
  function here()
  {
    echo '<pre>';
    echo 'function.php';
    echo ' @ ' . __FILE__;
    echo ' @ ' . __LINE__;
    echo ' @ ';
    debug_print_backtrace();
    echo '</pre>';
  }
}
