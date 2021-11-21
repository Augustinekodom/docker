<?php
require 'nav.php';
require 'side.php';
require 'setup.php';
?>

<?php 
$current_category_id  = $_GET['id'];
//$link = 'article.php?id='.$current_category_id;
$sql = "SELECT id, title, authour_firstname, authour_firstname, authour_surname, publishDate FROM article WHERE categoryId = $current_category_id";
$result = $pdo->query($sql);


  // output data of each row
while($row = $result->fetch()) {
    $id = $row['id'];
   $title = $row['title'];
   $authour_firstname = $row['authour_firstname'];
   $authour_surname = $row['authour_surname'];
   $date_posted = $row['publishDate'];
   $link = 'article.php?id='.$id;


    echo '<ul>';
    
   echo '<h3> '. 'Title:' . ' ' . $title . '</h3>';
   echo "<h5> Posted at:  $date_posted </h5>";
   //echo '<li><a class="articleLink" href="category.php?id=' . $categories['id'] . '"/>' . $categories['category_name'] .'</option>';
   
   echo '<a href=article.php?id="'. $id.'">Read Article' . '</a>';
   echo '<br></b>';
   echo '</ul>';
   
  }


?>