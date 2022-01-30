<h1>500 Internal Server Error</h1>

<?php
if (IS_LOCAL) {
  echo "<pre>";
  echo $context->error;
  echo "</pre>";
}
?>
