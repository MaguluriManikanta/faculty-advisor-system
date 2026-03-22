<?php
include 'db.php';

$conn->query("INSERT INTO meetings (student_id,faculty_id,date,message)
VALUES ('$_POST[student_id]','$_POST[faculty_id]','$_POST[date]','$_POST[message]')");

$conn->query("INSERT INTO notifications (user_id,message)
VALUES ('$_POST[student_id]','Meeting Scheduled')");

echo "Meeting Booked";
?>