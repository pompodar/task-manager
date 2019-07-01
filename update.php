<?php
 include("config.php");


  if(isset($_POST['numb'])){
	$numb = $_POST['numb'];
	$change = $_POST['change'];
    $completed = $_POST['completed'];
	
} else{

}

$sql = "UPDATE tasks SET task='$change' WHERE id='$numb'";
$sql1 = "UPDATE tasks SET completed='$completed' WHERE id='$numb'";
if ($db->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $db->error;
}
if ($db->query($sql1) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
$db->close();
 
 function get_post($db, $var)
 {
 return $conn->real_escape_string($_POST[$var]);
 }

 
