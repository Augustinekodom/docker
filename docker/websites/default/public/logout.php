<?php
session_start();
session_destroy();

require 'nav.php';

echo '<form>
  <a href="index.php">You have been logged out</a>
</form>';
require 'footer.php';
?>