<?php 

session_save_path(realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start(); 

session_destroy(); 


echo "<script>window.open('index.php','_self')</script>";


?>