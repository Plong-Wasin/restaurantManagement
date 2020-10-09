<?php
session_start();
unset($_SESSION['code']);
header("Location:../customer/enterCode.php");
