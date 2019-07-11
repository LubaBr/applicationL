<?php

require_once('settings.php');

//echo base64_encode(urlencode('NOW!'));exit;
//TEST value '?answer=Tk9XJTIx';

$action       = filter_input(INPUT_POST,'action',FILTER_SANITIZE_STRING);
$task_id      = filter_input(INPUT_POST,'task',FILTER_SANITIZE_STRING);
$question_id  = filter_input(INPUT_POST,'question',FILTER_SANITIZE_STRING);

$keep_answer='';

if($action == ''){

  $setting = new Settings();
  $auth_item = new AuthenticationLight($setting);
  //$keep_answer=filter_input(INPUT_GET,'answer',FILTER_SANITIZE_STRING);
  //$answer = urldecode(base64_decode($keep_answer));

  $question_id = $auth_item->getId();
  $view = false; //$auth_item->checkEntry($answer);

}elseif($action == 'verify'){

  $setting = new Settings($question_id);
  $auth_item = new AuthenticationLight($setting);
  //round with answer .. only here
  $keep_answer=filter_input(INPUT_POST,'answer',FILTER_SANITIZE_STRING);
  //$answer = urldecode(base64_decode($keep_answer));
  $view = $auth_item->checkEntry($keep_answer);
}
//Authentication Medium

$auth_html=$auth_item->createAuthBox();

$current_task_list = new TaskList();
$current_task_list_html= $current_task_list->createHtmlList();

$output='';
if( $view) { $output = $current_task_list_html; }else{ $output = $auth_html; }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Luba Bridgelal Lsoftware Leading Edge Software">
    <meta name="generator" content="Manual">
    <title>Broker Lift Task Manager</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

<main role="main">

<div class="container">
  <!-- Example row of columns -->
  <form id='form1' name='form1' method="POST">
  <div class="row">

      <div class="col-md-12">
        <h1>&nbsp;</h1>
      </div>

      <div class="col-md-6">
        <?php echo $output; ?>
      </div>

      <input type='hidden' name='keep_answer' id='keep_answer' value='<?php echo $keep_answer;?>'>
      <input type='hidden' name='action' id='action' value=''>
      <input type='hidden' name='question' id='question' value='<?php echo $question_id;?>'>
      <input type='hidden' name='task' id='task'  value='<?php echo $task_id;?>'>
  </div>
</form>
  <hr>
</div> <!-- /container -->

<?php
/*
 echo '<pre>';
 print_r($auth_item);
 print_r($_REQUEST);
 echo '</pre>';
*/
?>

</main>
</body>

<footer class='container'>
    <p>&copy; Lsoftware 2019 @LubaBridgelal</p>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>

$(document).ready(function () {
  $("#form1").on("click","#auth-button", (function(){
    $("#action").val("verify");
    $("#form1").submit();
    console.log("button pushed!");
  }));

});

  </script>
</html>
