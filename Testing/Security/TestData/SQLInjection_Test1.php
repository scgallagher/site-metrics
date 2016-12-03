<!DOCTYPE html>
<html>
<?php

  // Non-prepared - object oriented (mysql and mysqli)
  //$conn->query("fake query");
  // Non-prepared - procedural
  mysql_query("fake query");
  // Non-prepared - procedural
  mysqli_query("fake query");
  // Non-prepared - object oriented (PDO)
  //$conn->exec("fake statement");

  // Prepared - object oriented (mysqli and PDO)
  $conn->prepare("SELECT * FROM students WHERE firstname=?");
  $conn->bind_param("s", $firstname);
  $conn->execute();

}
?>
</html>
