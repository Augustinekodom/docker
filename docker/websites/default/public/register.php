<?php
require 'nav.php';
require 'setup.php';
require 'side.php';
?>



<form action = "register.php" method = "POST">
<label>First Name: </label><input name="firstname" type="text" placeholder="firstname" class="#" required="">
   
<label>Surname: </label><input  name="surname" type="text" placeholder="Surname" class="#" required="">
      
    
<label>Email: </label><input id="email" name="email" type="text" placeholder="Email" class="#" required="">
      
    
<label>Password: </label><input id="password" name="password" type="password" placeholder="Password" class="#" required="">
    
<input type="submit" name="register" value="Register" />    
</form>

<?php
// Store User details

if (isset($_POST['register'])) {
    //unset($_POST['register']);//Remove submit value from array
    //$date_posted = date('Y-m-d H:i:s');
	$stmt = $pdo->prepare("INSERT INTO users (firstname, surname, email, u_password)
						   VALUES (:firstname, :surname, :email, :u_password)");
    
    //hash the password
	$hash = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $values = [
		'firstname' => $_POST['firstname'],
		'surname' => $_POST['surname'],
        'email' => $_POST['email'],
        'u_password' => $hash
	];
	
	$stmt->execute($values);

	echo 'Record Has Been Added';

	//echo '<p href="index.php">Back to list</p>';
}

?>
<?php
require 'footer.php';
?>