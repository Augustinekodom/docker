<?php
require 'nav.php';
require 'setup.php';

?>

<form name="addCategory" method="POST" action="addCategory.php">

<label>Category Name</label>
<input  name="category_name" type="text" placeholder="Category Name">


<label>Existing Categories</label>
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

<input type="submit" value="submit" name="submit" />
<?php
if (isset($_POST['submit'])) {
    unset($_POST['submit']);//Remove submit value from array
    unset($_POST['category']);//Remove category value from array
    $date_added = date('Y-m-d H:i:s');
$stmt = $pdo->prepare('INSERT INTO categories (category_name, date_added)
                                                VALUES(:category_name, :date_added)
');

$values = [
    'category_name' => $_POST['category_name'],
    'date_added' => $date_added
];
$stmt->execute($values);
echo "<meta http-equiv='refresh' content='0'>";//refresh the page to show updated list
//https://stackoverflow.com/questions/10643626/refresh-page-after-form-submitting

}
?>

  </form>

<?php
require 'footer.php';
?>