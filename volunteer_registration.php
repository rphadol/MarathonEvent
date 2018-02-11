
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Registration Results</title>
	<link href="run.css" rel="stylesheet" type="text/css" />
</head>



<body>
<img src="Runn.jpg" alt="Run View" style="width:100%;height:228px;">

        <ul id="nav">
		  <li><a href="form.html">Home</a></li>
		  <li><a href="Volunteer_registration_form.html">Volunteer Registration</a></li>
		 <li><a href="contact.html">Contact</a></li>
		  <li><a href="about.html">About Us</a></li>
        </ul>	
			

 <?php
$all_information_provided = 1;

  $msg = "Thank you for registration on our web site as volunteer.";

  $today = date("m/d/y");

 $msg = $msg . "<br/>" . $today;

 
 if(!empty($_POST["FirstName"]) && !empty($_POST["FirstName"])&& !empty($_POST["phone"])&& !empty($_POST["email"])){
   $name = $_POST["FirstName"];
   $lname = $_POST["LastName"];
   $phone = $_POST["phone"];
   $email = $_POST["email"];
   
 $to = $email;
  $subject = "Registration";
  $body = $msg;
  if (mail($to, $subject, $body)) {
    echo("<p>Confirmation email message successfully sent!</p>");
  } else {
    echo("<p>Confirmation email message delivery failed...</p>");

   $all_information_provided = 0;
  }

  
  
     $Sucssesfull = $name  ." " . $lname. "<br/>" ."Contact Number:". $phone."<br/>". " (" . $email . ") " ;
      echo  $Sucssesfull;
} else {
   $msg = "Name, phone and email are required fields";

 $all_information_provided = 0;
}   



   
   
if (isset($_POST['pref_time'])) {
    $selected_radio = $_POST["pref_time"];
    echo "<p>You have choose timing: $selected_radio </p>";
  } 
  else {
    echo "<p>Time details were not provided.</p>";


 $all_information_provided = 0;
  }
  
  if(!empty($_POST['size'])){
    //read all provided values as an array and join them as comma separated string  
    $size =$_POST['size'];
    echo "<p>T-Shirt size: $size </p>";
  } else {
    echo "<p>No T-shirt size were provided.</p>";

 $all_information_provided = 0;
  }
  




if($all_information_provided == 1)
{
     $conn = mysqli_connect("localhost", "proxy_User3", 
       "my*password", "designstudio1") 
        or die("Cannot connect to database:" . 
           mysqli_connect_error($conn));



		  $query = mysqli_prepare($conn, 
			"INSERT INTO volunteers (FirstName,LastName,phone, email ) VALUES(?, ?, ?, ?)")
				or die("Error: ". mysqli_error($conn));

		   mysqli_stmt_bind_param ($query, "ssss",  $name, $lname, $phone, $email);
			   
		 
		   mysqli_stmt_execute($query)
			   or die("Error. Could not insert into the table." 
						   . mysqli_error($conn));

		  
		   $inserted_id = mysqli_insert_id($conn);
		   echo "Your data was recorded. It is entry #" . $inserted_id;
		   mysqli_stmt_close($query);  


		//Timing Table
			 
			   $query = mysqli_prepare($conn, 
    "INSERT INTO voltiming (id, pref_time) VALUES(?, ?)")
        or die("Error: ". mysqli_error($conn));

   // bind parameters "s" - string
   mysqli_stmt_bind_param ($query, "ss", $inserted_id, $selected_radio);
       
   //run the query mysqli_stmt_execute returns true if the 
   //query was successful 
   mysqli_stmt_execute($query)
       or die("Error. Could not insert into the table." 
                   . mysqli_error($conn));

		  

			 	// T-Shirt size table 
			 
			  
	        			 
			   $query = mysqli_prepare($conn, 
    "INSERT INTO volt_size (id, size) VALUES(?, ?)")
        or die("Error: ". mysqli_error($conn));

   // bind parameters "s" - string
   mysqli_stmt_bind_param ($query, "ss", $inserted_id, $size);
       
   //run the query mysqli_stmt_execute returns true if the 
   //query was successful 
   mysqli_stmt_execute($query)
       or die("Error. Could not insert into the table." 
                   . mysqli_error($conn));
}
	else {
     echo "<p>All information is required, use back button and complete all required fields.</p>";
         }
 
 echo $msg;
  ?>
  
    </body>
</html> 