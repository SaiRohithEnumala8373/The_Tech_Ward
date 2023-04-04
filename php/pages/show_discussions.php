

<?php
// $host = "localhost";
// $database = "project";
// $user = "webuser";
// $password = "P@ssw0rd";

use db\dbConnection;



require_once '../db/dbConnection.php';
$dbConnection = new dbConnection();
$connection = $dbConnection->getConnection();
$error = $dbConnection->getError();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
else{

    $sql = "SELECT discussionId, title, fullname, user.email FROM discussion, user WHERE discussion.email = user.email";
    $result = mysqli_query($connection, $sql);
}



?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="../../css/project.css">
    <link rel="stylesheet" href="../../css/nav.css">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>


  nav{
    position: fixed;
    top: 0;
  left: 0;
  right: 0;
  height: 100px;
  }

footer{
    position: fixed;
    left: 0;
  bottom: 0;
  height: 100px;
  }
</style>


  </head>
  <body>

  <nav>

        <div class="logo">  <a href = "show_discussions.php"><img src="../../Images/logo.png" width="100" height="100"></a> </div>
        <div class="n"><div class="text"> <a href = "show_discussions.php"><p> The Tech Ward</p> <a href = "show_discussion.php"></div>
            <ul>
              <li><a href="new_discussion.php">New Discussion</a></li>
                <li><a href="show_discussions.php">Discussions</a></li>
                <li><a href= "account.php">Account</a></li>
                <li><a href="admin/admin.php">Admin</a></li>
                <li><a href="../login/logout.php">Logout</a></li> 
              </ul>
            </nav>
  <br><br><br><br><br><br><br><br>
  
  <input name = "search" id = "searchBar" type = "search" placeholder = "Search For Discussions..." style = "width: 500px" onkeydown="displaySearchResultsOnEnterKeyPress(event)">
  <button id = "searchButton" onclick = "displaySearchResults()">Search</button>

  <div id = "discussionList">

<?php  

while ($row = $result->fetch_assoc()) {
  echo "<a href = discussion.php?discussionId=".$row["discussionId"]."> <h3> Title: ".$row["title"]." </h3> <br> User:".$row["fullname"]."</a>";
  session_start();
  if($_SESSION["admin"] || $row["email"] == $_SESSION['email']) {
      echo "<a href='../create/delete_discussion.php?discussionId=" . $row["discussionId"] . "'><button>Delete</button></a>";
      echo "<a href='edit_my_discussion.php?discussionId=" . $row["discussionId"] . "'><button>Edit</button></a>";
  }
}

?>

         </div>

         <footer>
            <a href="#">Home</a> | <a href="#">Browse</a> | <a href="#">Search</a><br><br>
            <small><i>Copyright &copy; 2023 The Tech Ward</i></small>
        </footer>

  </body>

</html>
<script>

    function displaySearchResultsOnEnterKeyPress(e)
    {
        if(e.key == "Enter")
            displaySearchResults();
    }

    function displaySearchResults(){


        const searchQuery = document.getElementById("searchBar").value;
        $.get("search_for_discussions.php", {search: searchQuery}, function(data){
            const searchResultsDiv = $("#discussionList");
            searchResultsDiv.html(data); // We are overwriting the previous changes/data
        });


    }
</script>