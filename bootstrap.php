<?php
session_start();
define("UPLOAD_DIR", "./resources/");
require_once("db/database.php");
require_once("funzioni/functions.php");

$dbh = new DatabaseHelper("localhost", "root", "", "database_tecnologie_web");
?>