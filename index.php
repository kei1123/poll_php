<?php
  require_once(__DIR__. '/config.php');
  require_once(__DIR__. '/Poll.php');

  try{
    $poll = new \MyApp\Poll();
  }catch(Exception $e){
    echo $e->getMessage();
    exit;
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $poll->post();
  }

  $err = $poll->getError();

?>

<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Poll</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <?php if(isset($err)) : ?>
    <div class="error"><?= h($err); ?></div>
  <?php endif; ?>
  <h1>Which do you link best?</h1>
  <form action="" method="post">
    <div class="row">
      <div class="box" id="box_0" data-id="0"></div>
      <div class="box" id="box_1" data-id="1"></div>
      <div class="box" id="box_2" data-id="2"></div>
      <input type="hidden" id="answer" name="answer" value="">
      <input type="hidden" name="token" name="answer" value="<?= h($_SESSION['token']);?>">
    </div>
    <div id="btn">Vote and See Results</div>
  </form>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>
  $(function() {
    'use strict';

    $('.box').on('click', function() {
    $('.box').removeClass('selected');
    $(this).addClass('selected');
    $('#answer').val($(this).data('id'));
    });

    $('#btn').on('click', function() {
      if ($('#answer').val() === '') {
        alert('Choose One!');
      } else {
        $('form').submit();
      }
    });

    $(".error").fadeOut(30000);
  });
  </script>
</body>
</html>