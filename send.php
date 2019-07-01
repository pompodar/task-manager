<?php
 include("config.php");

 
  $name = get_post($db, 'name');
  $email = get_post($db, 'email');
  $task = get_post($db, 'task');

 $query = "INSERT INTO tasks (name, email, task)
 VALUES ('$name', '$email', '$task')";
 $result = $db->query($query);
 header("location: admin.php");
   $connection->close();
function get_post($db, $var)
 {
 return $db->real_escape_string($_POST[$var]);
 }
require "index.php";

?>
