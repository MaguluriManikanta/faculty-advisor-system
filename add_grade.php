<?php
include 'db.php';

$conn->query("INSERT INTO grades (student_id,subject_id,grade)
VALUES ('$_POST[student_id]','$_POST[subject_id]','$_POST[grade]')");

$conn->query("INSERT INTO notifications (user_id,message)
VALUES ('$_POST[student_id]','Grade Updated')");

echo "Done";
?>