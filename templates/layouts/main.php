<?php require_once(SNIPPETS . 'header.php') ?>
<h1>Hexadecimal Framework</h1>
<ul>
  <li><?php echo CONTROLLER ?>@<?php echo METHOD ?></li>
  <li><?php echo SESSION_STARTED == 1 ? 'With session' : 'Without session'  ?></li>
  <li><?php echo FRAMEWORK_NAME ?> v<?php echo FRAMEWORK_VERSION ?></li>
  <li>PHP v<?php echo VERSION_PHP ?></li>
</ul>
<?php require_once(SNIPPETS . 'footer.php') ?>
