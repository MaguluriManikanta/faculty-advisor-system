<?php
include 'db.php';

$conn->query("INSERT INTO students(name,email,phone,year,class,gpa)
VALUES('$_POST[name]','$_POST[email]','$_POST[phone]','$_POST[year]','$_POST[class]','$_POST[gpa]')");

echo "Student Added";
?>