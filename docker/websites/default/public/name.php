<?php
session_start();
if (isset($_POST['submit'])) { $_SESSION['name'] = $_POST['name'];
    echo '<a href="welcome.php">Go to welcome</a>';
}
else{
?>
<form action = "name.php" method = "POST">
    
<input id="name" name="name" type="text" placeholder="Enter Your Name" class="#" required="">
      
<input type="submit" name="submit" value="Submit" /> 
</form>
<?php
}
?>


