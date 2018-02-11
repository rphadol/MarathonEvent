<html>
  <head>
    <title>Display Records</title>
  </head>
  <body>
    <?php
      $conn = new mysqli("localhost", "proxy_user2", 
            "my*password", "designstudio1");
      if (mysqli_connect_errno()){
          echo 'Cannot connect to database: ' . 
              mysqli_connect_error($conn);
      }
      else{
         echo "Connected to MySQL designstudio1 database.<br />";
         //specify query NOTE that first ; is the end of the query
         $email = $_POST["email"]; //"jdow@somedomain.com"; //
		 $query = "SELECT name, email, comments from guestBook WHERE email='$email';";
		 
		 //$query = "SELECT name, email, comments from guestBook;";
          //run the query and keep results in $result variable
         $result = mysqli_query($conn, $query);
         // Check the result
         if (!$result) {
            die("Invalid query: " . mysqli_error($conn));
         }
         else {
            echo "Successful query: " . $query . "<br />";
            //use loop to fetch records from $result
            //you can think about $result as a RECORDSET - a 
            //temporary object that holds a set of records from 
            // a database table
            //dispaly table headers
            echo "<table border='1'><tr><th>Name</th>
               <th>Email</th><th>Comments</th></tr>";

            while($row = mysqli_fetch_array($result)){
                // \r\n to print each row on new line
                echo "\r\n <tr><td>{$row['name']} </td>" .
                  "<td>{$row['email']} </td>" . 
                    "<td>{$row['comments']} </td></tr> ";
            }
            echo "</table>";

            mysqli_free_result($result);
         }
         mysqli_close($conn);
     }
	?>
  </body>
</html>
