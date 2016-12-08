<?php

  class urlException extends Exception {

    public function getHeading(){
      $heading = "URL Error";
      return $heading;
    }

    public function errorMessage(){
      $message = $this->getMessage();
      return $message;
    }

  }

?>
