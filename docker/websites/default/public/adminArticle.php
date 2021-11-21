<?php
require 'nav.php';
require 'adminSide.php';
require 'setup.php';
?>

<?php
$stmt = $pdo->prepare('SELECT id, title FROM article');
$stmt->execute();
//echo '<select name="category">';
while ($articles = $stmt->fetch()) {
echo '<a class="articleLink">' . $articles['title'];
echo '<br>';
echo '<a href="deleteArticle.php?id='.$articles['id'].'"</h5> <h5>Delete</h5>';
echo '<a href="editArticle.php?id='.$articles['id'].'"</h5> <h5>Edit</h5>';
echo '<a href="addArticle.php?id='.$articles['id'].'"</h5> <h5>Add New Article</h5>';
echo '<br>';
}

?>

<?php

?>
<?php
require 'footer.php';
?>

