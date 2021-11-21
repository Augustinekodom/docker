<?php
require 'theSession.php';
require 'nav.php';
require 'side.php';
require 'setup.php';


$id_id = $_GET['id'];
// get id and put in DB
$stmt = $pdo->prepare("INSERT article_id_table(id_from_db) 
                        VALUES($id_id)");
$stmt->execute();
// get the id from DB
$stmt3 = $pdo->prepare("SELECT * FROM article_id_table ORDER BY Id DESC LIMIT 1;
");
$stmt3->execute();
$article_db_content = $stmt3->fetch();
//var_dump($article_db_content);
$current_a_id = $article_db_content['id_from_db'];

?>

<?php
$current_article_id  = $current_a_id;
//$current_article_id2 = 5;
$stmt = $pdo->prepare("SELECT title, summary, content, authour_firstname, authour_surname, publishDate 

FROM article WHERE id = $current_article_id ");
$stmt->execute();
$collected_data = $stmt->fetch();

$url = "article.php?id=".$current_a_id;
?>

<h1><?php echo $collected_data['title'];?></h1>
<p><?php echo $collected_data['summary'];?></p>
<p><?php echo $collected_data['content'];?></p>
<p><?php echo '<h4>Authour name: </h4>'.$collected_data['authour_firstname'].' '.$collected_data['authour_surname'];?></p>
<p><?php echo '<em>Date Published: </em>'.$collected_data['publishDate'];?></p>

<form name="comment_box" method="POST" action="<?php echo $url;?>">
    <h4>Comments</h4>
    <input type='text' name='first_name' placeholder='First Name'>
    <input type='text' name='second_name' placeholder='Second Name'>
	<input type ='text' name='a_comment' placeholder=' Type Comment Here'>
	<input type ='submit' name="post"/>
</form>
<?php

// add comments to page
if (isset($_POST['post'])) {
    unset($_POST['post']);//Remove submit value from array
    $date_added = date('Y-m-d H:i:s');
$stmt2 = $pdo->prepare('INSERT INTO comment (first_name, second_name, a_comment, article_id, date_posted)
                                            VALUES(:first_name, :second_name, :a_comment, :article_id, :date_posted)');

$values = [
    'first_name' => $_POST['first_name'],
    'second_name' => $_POST['second_name'],
    'a_comment' => $_POST['a_comment'],
    'article_id' => $current_a_id,
    'date_posted' => $date_added
];
$stmt2->execute($values);
}

// Show comments onto the page
$stmt4 = $pdo->prepare("SELECT id, first_name, second_name, a_comment, date_posted FROM comment WHERE article_id = '$current_article_id';");
//$result = $pdo->query($stmt4);

$stmt4->execute();




  // output data of each row
  while($row = $stmt4->fetch()) {
    $id = $row['id'];
   $first_name = $row['first_name'];
   $second_name = $row['second_name'];
   $a_comment = $row['a_comment'];
   $date_posted = $row['date_posted'];

    
   echo '<h4> '. $first_name .' '.$second_name.' said: '.$a_comment.' at: '.$date_posted. '</h4>';

   echo '<br></b>';
   
  }


?>


<?php
require 'footer.php';
?>