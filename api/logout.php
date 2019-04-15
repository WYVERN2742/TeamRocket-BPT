<?php

session_start();

if (isset($_POST["do_logout"])) {
	unset($_SESSION['user']);
}

header("Location: ../index.php");
die();