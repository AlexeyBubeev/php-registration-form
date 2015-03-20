include("db.php");

$login = ($_POST['login']);
$password = ($_POST['password']);
$rpassword = ($_POST['rpassword']);
$email = ($_POST['email']);
$humancheck = $_POST['humancheck'];
$honeypot = $_POST['honeypot'];

if ($honeypot == 'http://' && empty($humancheck)) { 
$error_message = '';
$reg_exp = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9-]+\.[a-Za-Z.](2,4)$/";
if(!preg_match($reg_exp, $email)){
$error_message .="<p>A Valid email is required</p>";
}
if(empty($login)){
$error_message .="<p>enter login</p>";
}
if(empty($password)){
$error_message .="<p>Enter password</p>";
}
if(empty($rpassword)){
$error_message .="<p>Enter password again</p>";
}
if($password != $rpassword){
$error_message .="<p>password mut match</p>";
}
} 
else {
$return['error'] = true;
$return['msg'] = "<h3>There was a problem with your submission. Please try again.</h3>";    
    echo json_encode($return);
}