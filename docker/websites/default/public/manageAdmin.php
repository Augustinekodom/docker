
<?php
require 'nav.php';
require 'setup.php';
require 'adminSide.php';
?>


<label>Admins</label>


<?php


$stmt = "SELECT * FROM admins";
$result = $pdo->query($stmt);

 // output data of each row
 while($row = $result->fetch()) {
    $id = $row['id'];
   $email = $row['email'];
   $link = 'deleteAdmin.php?id='.$id;
   $link2 = 'addAdmin.php';
   
    echo '<ul>';
    echo "<h3> $email </h3>";
    echo '<a href="'. $link.'"><button><h4>Delete Admin</h4>' . '</button></a>';
    echo '<br></b>';
    echo '</ul>';
   
  }
  echo '<a href="'. $link2.'"><button><h3>Add New Admin</h3>' . '</button></a>';
?>

<?php
if (isset($_POST['delete'])) {
$admin_id = $_GET['id'];
$disable_fk = $pdo->prepare ("SET FOREIGN_KEY_CHECKS=0;");
$enable_fk = $pdo->prepare ("SET FOREIGN_KEY_CHECKS=1;");
$stmt = $pdo->prepare(" DELETE FROM admins WHERE id = '$admin_id'");
    
    $disable_fk->execute();// disable constraints
    $stmt->execute(); // Alter table
    echo "Admin deleted";
    $enable_fk->execute();// re-enable constraints
    //echo "<meta http-equiv='refresh' content='0'>";
}

?>




<?php
require 'footer.php';
?>