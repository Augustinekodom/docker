<?php
//require 'nav.php';
require 'setup.php';
?>

<form name="deleteCategory" method="POST" action="deleteCategory.php">

<label>Select Categories</label>
<?php
//fetch the categorise from database and put into slect dropdown.
$stmt = $pdo->prepare('SELECT id, category_name FROM categories');
$stmt->execute();
echo '<select name="category">';
while ($categories = $stmt->fetch()) {
echo '<option value="' . $categories['id'] . '">' . $categories['category_name'] .'</option>';
}
echo '</select>';
?>

<input type="submit" value="delete" name="delete" />
<?php


//echo 'the id is '.$cat_id;
if (isset($_POST['delete'])) {
    $cat_id = $_POST['category'];
    //https://tableplus.com/blog/2018/08/mysql-how-to-temporarily-disable-foreign-key-constraints.html
    $disable_fk = $pdo->prepare ("SET FOREIGN_KEY_CHECKS=0;");
    $enable_fk = $pdo->prepare ("SET FOREIGN_KEY_CHECKS=1;");
    $stmt = $pdo->prepare(" DELETE FROM categories WHERE id = '$cat_id'");
    
    $disable_fk->execute();// disable constraints
    $stmt->execute(); // Alter table
    $enable_fk->execute();// re-enable constraints
    echo "<meta http-equiv='refresh' content='0'>";
}
?>

  </form>

<?php
require 'footer.php';
?>