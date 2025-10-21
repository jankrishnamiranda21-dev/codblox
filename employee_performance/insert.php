<?php
include 'db.php';

$name = $_POST['name'];
$department = $_POST['department'];
$performance = $_POST['performance'];

$sql = "INSERT INTO employees (name, department, performance) VALUES ('$name', '$department', '$performance')";
$conn->query($sql);

header("Location: index.php");
?>
