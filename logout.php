<!DOCTYPE html>
<html>
<head>
<title>logout</title>
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


<table id="stage">
<tr>

	

<td>



<?php

$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (isset($_COOKIE[session_name("PHPSESSID")])) {
    setcookie(session_name("PHPSESSID "), '', time()-42000, '/');
}

// Finally, destroy the session.
@session_destroy();
header('Location: form.html');
?>
</td>
<?php

?>
</tr>
</table>	
</div>
</body>
</html>