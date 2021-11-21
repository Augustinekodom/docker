
<?php
require 'nav.php';
require 'setup.php';
?>

<form name="addArticle" method="POST" action="addArticle.php">
  
<input  name="title" type="text" placeholder="Article Title">
<input  name="summary" type="text" placeholder="Article summary">
<input  name="content" type="text" placeholder="Main Article story"><br>

<label>Category</label>
<select name="category" id="category">//fetch this from the database later
  

<?php
$stmt = $pdo->prepare('SELECT id, category_name FROM categories');
$stmt->execute();
//echo '<select name="category">';
while ($categories = $stmt->fetch()) {
echo '<option value="'.$categories['id'].'">'.$categories['category_name'].'</option>';
//echo '<li><a class="articleLink" href="category.php?id=' . $categories['id'] . '"/>' . $categories['category_name'] .'</option>';
}

?>
                        
</select>


<label>Authour First name</label>
<input name="authour_firstname" type="text"/>
<label>Authour surname</label>
<input name="authour_surname" type="text"/>
<input type="submit" value="submit" name="submit" />
  </form>
  
<?php

if (isset($_POST['submit'])) {
    unset($_POST['submit']);//Remove submit value from array
    $date_posted = date('Y-m-d H:i:s');
	$stmt = $pdo->prepare('INSERT INTO article(title, summary, content, authour_firstname, authour_surname, categoryId, publishDate)
						   VALUES ( :title, :summary, :content, :authour_firstname, :authour_surname, :categoryId, :publishDate)');
    
    
    $values = [
		'title' => $_POST['title'],
		'summary' => $_POST['summary'],
        'content' => $_POST['content'],
        'authour_firstname' => $_POST['authour_firstname'],
        'authour_surname' => $_POST['authour_surname'],
        'categoryId' => $_POST['category'],
        'publishDate' => $date_posted
	];
	
	$stmt->execute($values);

	echo 'Record Has Been Added';

	echo '<a href="index.php">Back to list</a>';
}
?>

<?php
require 'footer.php';
?>