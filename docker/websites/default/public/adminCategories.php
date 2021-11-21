<?php
require 'nav.php';
require 'setup.php';
?>

<?php
$stmt = $pdo->prepare('SELECT id, category_name,date_added FROM categories');
$stmt->execute();
//echo '<select name="category">';
while ($categories = $stmt->fetch()) {
echo '<a class="articleLink" href="category.php?id=' . $categories['id'] . '"/>' . $categories['category_name'];
echo '<br>';
echo '<a href="deleteCategory.php?id='.$categories['id'].'"</h5> <h5>Delete</h5>';
echo '<a href="editCategory.php?id='.$categories['id'].'"</h5> <h5>Edit</h5>';
echo '<a href="addCategory.php?id='.$categories['id'].'"</h5> <h5>Add New Category</h5>';
echo '<br>';
}

?>

<?php

?>
<?php
require 'footer.php';
?>

