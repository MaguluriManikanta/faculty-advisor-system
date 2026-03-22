<?php
include 'db.php';

if(isset($_POST['submit'])){
    $subject = $_POST['subject'];

    $sql = "INSERT INTO subjects (subject_name)
            VALUES ('$subject')";

    if($conn->query($sql)){
        echo "Subject Added Successfully";
    } else {
        echo "Error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Subject</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
<div class="card p-4 shadow">

<h2>Add Subject</h2>

<form method="POST">
<input class="form-control mb-2" name="subject" placeholder="Subject Name" required>
<button class="btn btn-success w-100" name="submit">Add Subject</button>
</form>

</div>
</div>

</body>
</html>