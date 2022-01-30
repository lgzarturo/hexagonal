<!DOCTYPE html>
<html lang="<?php echo $context->language ?? 'es' ?>">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php echo $context->title ?? FRAMEWORK_NAME ?>
  </title>
</head>

<body>
  <?php echo isset($context->backgroundClass) ? 'black' : 'light' ?>
  <?php echo get_alerts() ?>
