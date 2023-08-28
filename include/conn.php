<?php
$con= new mysqli("localhost","root","","socialapp");
if ($con->connect_error) die("please check your connection");


session_start();

?>