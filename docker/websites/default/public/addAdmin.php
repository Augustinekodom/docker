<?php
require 'nav.php';
require 'adminSide.php';
require 'setup.php';

?>

<form name="addAdmin" method="POST" action="addAdmin.php">

<label>Add New Admin</label>
<input  name="email" type="text" placeholder="Email">
<input  name="admin_password" type="password" placeholder="Password">
<input type="submit" value="submit" name="submit" />
<?php

?>


<?php
if (isset($_POST['submit'])) {
    unset($_POST['submit']);//Remove submit value from array
    //unset($_POST['category']);//Remove category value from array
$stmt = $pdo->prepare('INSERT INTO admins (email, admin_password)
                                                VALUES(:email, :admin_password)
');

//hash the password
$hash = password_hash($_POST['admin_password'],PASSWORD_DEFAULT);
//echo $hash;
$values = [
    'email' => $_POST['email'],
    'admin_password' => $hash
];
$stmt->execute($values);
echo "New Admin Added";
echo "<meta http-equiv='refresh' content='0'>";//refresh the page to show updated list
//https://stackoverflow.com/questions/10643626/refresh-page-after-form-submitting

}
?>

  </form>

<?php
require 'footer.php';
?>