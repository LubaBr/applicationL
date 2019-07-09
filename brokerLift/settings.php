<?php

//Simplified settings

//Proposed Additions
//Only required info is here - should be saved in encrypted table for more security
//Introduce a rotation of question and answers in the above table
//Include a secure private key to encrypt answers in the table

require_once('tools.php');

class Settings{
  private $answer = '';
  private $question = '';

  public function __construct(){
    //for light case purpose
    $this->answer = 'NOW!';
    $this->question = 'When do you want it?';
}
  //should be a randon draw from table for better security, simplified version


  public function getAnswer(){
    return $this->answer;
  }

  public function getQuestion(){
    return $this->question;
  }
}


?>
