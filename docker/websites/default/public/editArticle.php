<?php
require 'nav.php';
require 'setup.php';
require 'adminSide.php';
?>
<?php
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

$url = "editarticle.php?id=".$current_a_id;

?>

<form name="" method="POST" action="<?php echo $url;?>">

<label>Edit Article</label><br>

<?php
// get the id of the category being edited.
$cat_id_edit = $current_a_id;
//echo $cat_id_edit;// what's the id
//fetch the categorise from database and put into textbox.
$stmt = $pdo->prepare("SELECT * FROM article WHERE id = '$cat_id_edit'");
$stmt->execute();
//$categories = $stmt->fetch();
while ($article = $stmt->fetch()) {
    echo '<input type="text" name="new_title" value="'.$article['title'].'"/>';
    echo '<input type="text" name="new_summary" value="'.$article['summary'].'"/>';
    echo '<textarea type="text" name="new_body" value="">'.$article['content'].'</textarea>';

    //fetch the categorise from database and put into slect dropdown.
$stmt = $pdo->prepare('SELECT id, category_name FROM categories');
$stmt->execute();
echo '<select name="category">';
while ($categories = $stmt->fetch()) {
echo '<option value="' . $categories['id'] . '">' . $categories['category_name'] .'</option>';
}
echo '</select>';

    echo '<input type="text" name="new_firstname" value="'.$article['authour_firstname'].'"/>';
    echo '<input type="text" name="new_surname" value="'.$article['authour_surname'].'"/>';
    echo '<input type="submit" value="Update" name="Update" />';
} 

?>

<?php

//echo 'the id is '.$cat_id;
if (isset($_POST['Update'])) {
  $new_title = $_POST['new_title'];
  $new_summary = $_POST['new_summary'];
  $new_body = $_POST['new_body'];
  $new_firstname = $_POST['new_firstname'];
  $new_surname = $_POST['new_surname'];
  $new_date = date('Y-m-d H:i:s');
  $new_category = $_POST['category'];


    $cat_id = $_POST['category'];
    //https://tableplus.com/blog/2018/08/mysql-how-to-temporarily-disable-foreign-key-constraints.html
    $disable_fk = $pdo->prepare ("SET FOREIGN_KEY_CHECKS=0;");
    $enable_fk = $pdo->prepare ("SET FOREIGN_KEY_CHECKS=1;");
    $stmt = $pdo->prepare("UPDATE article SET title = '$new_title', summary = '$new_summary',content ='$new_body',categoryId ='$new_category', authour_firstname='$new_firstname', authour_surname='$new_surname', publishDate ='$new_date' WHERE id = '$cat_id_edit';");
    
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