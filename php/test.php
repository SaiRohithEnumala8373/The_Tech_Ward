<!DOCTYPE html>
<html>

<p>Here are some results:</p>

<?php

$host = "cosc360.ok.ubc.ca";
$database = "db_11505328";
$user = "11505328";
$password = "11505328";



$connection = mysqli_connect($host, $user, $password, $database);


$error = mysqli_connect_error();
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
else
{
    //good connection, so do you thing
    $sql = "SELECT * FROM user;";

    $results = mysqli_query($connection, $sql);

    //and fetch requsults
    while ($row = mysqli_fetch_assoc($results))
    {
      echo $row['fullname']." ".$row['email']."<br/>";
      echo "
      <img src = 'data:image/png;base64,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' />
      ";
    }

    mysqli_free_result($results);
    mysqli_close($connection);
}
?>
</html>
