<?

function here()
{
  echo '<pre>';
  echo 'custom.php';
  echo ' @ ' . __FILE__;
  echo ' @ ' . __LINE__;
  echo ' @ ';
  debug_print_backtrace();
  echo '</pre>';
}
