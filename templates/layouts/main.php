<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Hola mundo</h1>
  <ul>
    <li><?php echo CONTROLLER ?>@<?php echo METHOD ?></li>
    <li><?php echo SESSION_STARTED == 1 ? 'Con sesión' : 'Sin sesión'  ?></li>
    <li><?php echo FRAMEWORK_NAME ?> v<?php echo VERSION_HEXAGONAL ?></li>
    <li>PHP v<?php echo VERSION_PHP ?></li>
  </ul>
</body>

</html>
