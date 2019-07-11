<?php

class AuthenticationLight{
      private $id='';
      private $question='';
      private $answer='';
      private $date='';

      public function __construct($setting){
          $this->id = $setting->getId();
          $this->question = $setting->getQuestion();
          $this->answer   = $setting->getAnswer();
          $this->date     = $setting->getDate();
      }

      public function getId(){
        return $this->id;
      }

      public function getDate(){
        return $this->date;
      }
      public function getAnswer(){
        return $this->answer;
      }

      public function getQuestion(){
        return $this->question;
      }

      public function checkEntry($entry){
        if($this->getAnswer() === $entry){  //add case non sensetive if needed
          return true;
        }else{
          return false;
        }
      }

      public function createAuthBox(){
        $html='
        <div class="input-group mb-3">
          <div class="input-group-prepend">

            <button class="btn btn-outline-secondary" type="button" id="auth-button" name="auth-button">'.$this->question.'</button>

          </div>
          <input type="text" class="form-control" placeholder="Answer" aria-label="Answer" aria-describedby="basic-addon1" id="answer" name="answer">
          <span class="input-group-text" id="auth-error"></span>
        </div>
        ';

        return $html;
      }

}

class TaskList{
  private $taskList=array();
  private $source='tasks.txt';

  public function __construct($list=''){
    if($list == ''){
      //load from file
      $file=file($this->source,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      foreach($file as $a => $item){
        $task_item=explode('|', $item);
        $this->taskList[] = new Task($task_item);
      }
    }else{
      foreach($list as $s => $item){
        $this->taskList[] = new Task($item[0], $item[1]);
      }
    }

  }

  public function createHtmlList(){
    $html='';
    $html_li='';

    foreach($this->taskList as $n => $task){

      if($task->checked){
        $task_type='primary';
        $task_check=' checked="checked"';
      }else{
        $task_type='warning';
        $task_check='';
      }

      //$html_li .= "<a href='#' class='list-group-item list-group-item-action list-group-item-{$task_type}'>{$task->task}</a>";
      $html_li .=
  '<div class="input-group mb-3">
    <div class="input-group-prepend">
    <div class="input-group-text">
      <input type="checkbox" '.$task_check.' aria-label="Checkbox for following text input">
    </div>
  </div>
  <input type="text" class="form-control" aria-label="Task description" value="'.$task->task.'">
</div>';


    }

    $html = '<div class="list-group">'.$html_li.'</div>';

    return $html;

  }

}

class Task{
  public $id='';
  public $task='';
  public $checked=false;
  public $date='';

  public function __construct($task, $checked = ''){
    if( $checked != ''){
      $this->task = $task;
      $this->checked=$checked;
    }else{
      $this->id   = $task['0'];
      $this->task = $task['1'];
      $this->checked = $task['2'];
      $this->date    = $task['3'];
    }
  }
}



 ?>
