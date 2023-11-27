<?php
$link = mysql_connect('localhost', 'akhbar', '7WRXCTMHmaqX');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';

//select a database to work with
$selected = mysql_select_db("akhbar_viv",$link)
  or die("Could not select examples");

//execute the SQL query and return records
$result = mysqli_query("SELECT id, title,image FROM articles limit 0,5");

//fetch tha data from the database
while ($row = mysql_fetch_array($result)) {
   echo "ID:".$row{'id'}." title:".$row{'title'}."image: ". //display the results
   $row{'image'}."<br>";
}
//close the connection
mysql_close($link);
?>

