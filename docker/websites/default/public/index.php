<?php
require 'nav.php';
require 'side.php';
require 'setup.php';

?>

<?php
$sql = "SELECT id, title, authour_firstname, authour_firstname, authour_surname, publishDate FROM article LIMIT 10";
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
    
   echo '<a href="'.$link.'"><h3>'. 'Title:' . ' ' . $title . '</h3></a>';
   echo "<em> Posted at:  $date_posted </em>";
   //echo '<li><a class="articleLink" href="category.php?id=' . $categories['id'] . '"/>' . $categories['category_name'] .'</option>';
   
   echo '<br></b>';
   echo '<br></b>';
   echo '</ul>';
   
  }

?>


<?php

require 'footer.php';
?>
