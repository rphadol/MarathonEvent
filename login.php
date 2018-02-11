<html>
  <head>
    <title>LDAP Test</title>
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
<a href="logout.php">Logout</a>
<?php
@session_start(); //start session

//see http://phpsec.org/projects/guide/4.html
if (!isset($_SESSION['authenticated'])) {
    session_regenerate_id();
    $_SESSION['authenticated'] = 0;
}
$name = $_POST["username"];
  $pass = $_POST["password"];

// using ldap bind
$ldaprdn  = 'cn=' . $name . ',dc=designstudio1,dc=com'; 
$ldappass = $pass; // associated password 'your*password'
// connect to ldap server
$ldapconn = ldap_connect("localhost")
    or die("Could not connect to LDAP server.");


if (ldap_set_option($ldapconn,LDAP_OPT_PROTOCOL_VERSION,3))
{
    echo "";//"Using LDAP v3";
}else{
    echo "Failed to set version to protocol 3";
}

if ($ldapconn) {

    // binding to ldap server
    $ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);

    // verify binding
    if ($ldapbind) {
      $_SESSION["authenticated"] = 1; 
      $_SESSION["user"] = $name; 

      echo  '<p>Welcome, ' . $_SESSION["user"] . '</p>';
     

    } else {
      $_SESSION["authenticated"] = 0;
        echo "try again...";
    }

}


?>
</body>
</html>
