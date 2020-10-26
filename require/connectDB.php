<?php

$conn = mysqli_connect("localhost", "root", "", "restaurant_db");

if (!$conn) {
    die("Failed to connect to database " . mysqli_error($conn));
}
