<?

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
