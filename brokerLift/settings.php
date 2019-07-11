<?php

//Simplified settings

//Proposed Additions
//Only required info is here - should be saved in encrypted table for more security
//Introduce a rotation of question and answers in the above table
//Include a secure private key to encrypt answers in the table

require_once('tools.php');

class Settings{
  private $id='';
  private $answer = '';
  private $question = '';
  private $date='';
  private $source = 'questions.txt';

  public function __construct($id=''){
    //read in the file
    $file=file($this->source,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $use_question=array();

    foreach($file as $q => $line){
        $temp=explode("|", $line);
        if($temp['0'] == $id){
          $use_question = $temp;
          break;
        }
    }

    //could be faulty because id is not line in the array -> test this
    if($id == '' or (count($use_question) == '0') ){
      $target       = rand(0, (count($file)-1));
      $use_question = explode('|', $file[$target]);
    }
    //format
    //QuestionID|Question|Answer|DateTime added/updated

    //encode the file next -> next table with encrypted columns

    $this->id = $use_question['0'];
    $this->answer = $use_question['2'];
    $this->question = $use_question['1'];
    $this->date     = $use_question['3'];
}

  public function getAnswer(){
    return $this->answer;
  }

  public function getQuestion(){
    return $this->question;
  }

  public function getId(){
    return $this->id;
  }
  public function getDate(){
    return $this->date;
  }



}


?>
