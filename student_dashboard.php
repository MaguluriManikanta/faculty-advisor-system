<?php
include 'db.php';

// Check ID
if(!isset($_GET['id'])){
    die("Student ID not provided");
}

$id = $_GET['id'];

// Fetch student
$result = $conn->query("SELECT * FROM students WHERE id='$id'");

if($result->num_rows == 0){
    die("Student not found");
}

$student = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

<div class="d-flex justify-content-between align-items-center">
    <h2 class="text-primary">Student Dashboard</h2>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>

<!-- Profile -->
<div class="card p-3 mt-3">
<h4>Profile</h4>
Name: <?php echo $student['name']; ?><br>
Email: <?php echo $student['email']; ?><br>
GPA: <?php echo $student['gpa']; ?><br>
</div>

<!-- Faculty -->
<div class="card p-3 mt-3">
<h4>Faculty</h4>
<?php
$res = $conn->query("SELECT faculty.name FROM faculty 
JOIN advisor ON faculty.id = advisor.faculty_id 
WHERE advisor.student_id='$id'");

if($res && $res->num_rows > 0){
    $row = $res->fetch_assoc();
    echo $row['name'];
} else {
    echo "No advisor assigned";
}
?>
</div>

<!-- Grades -->
<div class="card p-3 mt-3">
<h4>Grades</h4>
<?php
$sql = "SELECT subjects.subject_name, grades.grade 
FROM grades 
JOIN subjects ON grades.subject_id = subjects.id 
WHERE grades.student_id='$id'";

$res = $conn->query($sql);

if($res && $res->num_rows > 0){
    while($r=$res->fetch_assoc()){
        echo $r['subject_name']." - ".$r['grade']."<br>";
    }
} else {
    echo "No grades available";
}
?>
</div>

<!-- Notifications -->
<div class="card p-3 mt-3">
<h4>Notifications</h4>
<?php
$res=$conn->query("SELECT * FROM notifications WHERE user_id='$id'");

if($res && $res->num_rows > 0){
    while($r=$res->fetch_assoc()){
        echo $r['message']."<br>";
    }
} else {
    echo "No notifications";
}
?>
</div>

<!-- Meetings -->
<div class="card p-3 mt-3">
<h4>Meetings</h4>
<?php
$res=$conn->query("SELECT * FROM meetings WHERE student_id='$id'");

if($res && $res->num_rows > 0){
    while($r=$res->fetch_assoc()){
        echo $r['date']." - ".$r['message']."<br>";
    }
} else {
    echo "No meetings scheduled";
}
?>
</div>

</div>

</body>
</html>
