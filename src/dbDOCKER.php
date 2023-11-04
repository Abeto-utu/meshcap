<?php $conn = new mysqli("database", "root", "root", "meshcap");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} ?>