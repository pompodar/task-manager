<?php
 include("config.php");


 $query = "SELECT * FROM tasks ORDER BY id DESC";
 $result = $db->query($query);
 if (!$result) die ("newbase access failed: " . $db->error);

 $data = array();
while ($rows = mysqli_fetch_object($result))
{
    array_push($data, $rows);
}
echo json_encode($data);

 
echo <<<_END
 
_END;
$db->close();
 
function get_post($db, $var)
 {
 return $db->real_escape_string($_POST[$var]);
 }
?>