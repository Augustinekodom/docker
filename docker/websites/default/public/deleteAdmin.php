<?php
require 'nav.php';
require 'setup.php';
?>



<?php

$admin_id = $_GET['id'];
$disable_fk = $pdo->prepare ("SET FOREIGN_KEY_CHECKS=0;");
$enable_fk = $pdo->prepare ("SET FOREIGN_KEY_CHECKS=1;");
$stmt = $pdo->prepare(" DELETE FROM admins WHERE id = '$admin_id'");
    
    $disable_fk->execute();// disable constraints
    $stmt->execute(); // Alter table
    echo "Admin deleted";
    $enable_fk->execute();// re-enable constraints
    $link2 = 'manageAdmin.php';

    echo '<a href="'. $link2.'"><button><h3>Go Back</h3>' . '</button></a>';
    //echo "<meta http-equiv='refresh' content='0'>";

?>




<?php
require 'footer.php';
?>