<?php
include 'db.php';

if(isset($_POST['submit'])){
    $student_id = $_POST['student_id'];
    $faculty_id = $_POST['faculty_id'];

    $sql = "INSERT INTO advisor (student_id, faculty_id)
            VALUES ('$student_id','$faculty_id')";

    if($conn->query($sql)){
        echo "Advisor Assigned Successfully";
    } else {
        echo "Error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Assign Advisor</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
<div class="card p-4 shadow">

<h2>Assign Advisor</h2>

<form method="POST">
<input class="form-control mb-2" name="student_id" placeholder="Student ID" required>
<input class="form-control mb-2" name="faculty_id" placeholder="Faculty ID" required>

<button class="btn btn-warning w-100" name="submit">Assign</button>
</form>

</div>
</div>

</body>
</html>