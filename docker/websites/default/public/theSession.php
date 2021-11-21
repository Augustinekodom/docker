<?php
session_start();
if (isset($_SESSION['loggedin'])) {
echo 'You are seeing this because you are logged in';
}
else {
echo 'Sorry, you must be logged in to view this page.';
}
?>