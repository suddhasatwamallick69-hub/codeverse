<?php
session_start();
session_name("teacher");

session_destroy();
header("location:index.php");

?>