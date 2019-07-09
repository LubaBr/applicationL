<?php

class AuthenticationLight{
      private $question='';
      private $answer='';

      public function __construct($setting){
          $this->question = $setting->getQuestion();
          $this->answer   = $setting->getAnswer();
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

            <button class="btn btn-outline-secondary" type="button">'.$this->question.'</button>


            <!--span class="input-group-text" id="basic-addon1">'.$this->question.'</span-->
          </div>
          <input type="text" class="form-control" placeholder="Answer" aria-label="Answer" aria-describedby="basic-addon1">
        </div>
        ';

        return $html;
      }

}

class TaskList{
  private $taskList=array();

  public function __construct($list){
    foreach($list as $item){
        $this->taskList[] = new Task($item[0], $item[1]);
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
  public $task='';
  public $checked=false;

  public function __construct($task, $checked){
    $this->task = $task;
    $this->checked=$checked;
  }
}



 ?>
