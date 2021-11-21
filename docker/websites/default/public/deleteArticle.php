<?php
require 'nav.php';
require 'setup.php';
?>


<label>Delete Article</label>


<?php

$article_id = $_GET['id'];
$disable_fk = $pdo->prepare ("SET FOREIGN_KEY_CHECKS=0;");
$enable_fk = $pdo->prepare ("SET FOREIGN_KEY_CHECKS=1;");
$stmt = $pdo->prepare(" DELETE FROM articles WHERE id = '$article_id'");
    
    $disable_fk->execute();// disable constraints
    $stmt->execute(); // Alter table
    echo "Article deleted";
    $enable_fk->execute();// re-enable constraints
    //echo "<meta http-equiv='refresh' content='0'>";


?>



<?php
require 'footer.php';
?>