<?php

class DataManager {

  private $servername = "localhost";
  private $username = "site-metrics";
  private $password = "site-metrics";
  private $dbname = "site_metrics";
  private $connection;

  private $url;
  private $email;
  private $timeStamp;

  public function __construct($url, $email){
    $this->url = $url;
    $this->email = $email;
    $this->connnection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  }

  // private function insert(){
  //   $stmt = $connection->prepare();
  //   $stmt->execute();
  // }

}

?>
