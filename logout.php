<?php
session_start();
require("classes.php");
$logbook = new logbook;
$logbook->logout();

?>