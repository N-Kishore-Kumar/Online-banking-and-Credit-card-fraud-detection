<?php
session_start();
session_destroy();
header('Location: logoutpage.php?msg=' . urlencode("You have been successfully logged out!"));
?>
