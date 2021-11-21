<?php
session_start();
require 'nav.php';
require 'side.php';
require 'setup.php';

?>
<form action = "adminLogin.php" method = "POST">      
    
<label>Email: </label><input id="email" name="email" type="text" placeholder="Email" class="#" required="">
      
    
<label>Password: </label><input id="password" name="password" type="password" placeholder="Password" class="#" required="">
    
<input type="submit" name="login" value="Log In" />    
</form>

<?php
if (isset($_POST['login'])) {
    $stmt = $pdo->prepare('SELECT * FROM admins WHERE email = :email'); 
$values = ['email' => $_POST['email']];
$stmt->execute($values);

$users = $stmt->fetch();
if (password_verify($_POST['password'], $users['admin_password'])) { 
    $_SESSION['loggedin'] = true;
    $_SESSION['user'] = $users['id'];
    //header("Location: index.php");
    echo "<p>Log in successful</p>";
} 
else {
    echo '<p>Sorry, your account could not be found</p>';
}

}
?>
<?php
require 'footer.php';
?>