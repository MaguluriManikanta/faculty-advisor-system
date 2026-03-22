<?php
include 'db.php';

$student_id = $_GET['id'];

// Get student info
$student = $conn->query("SELECT * FROM students WHERE id='$student_id'")->fetch_assoc();

// Get student grades
$grades = $conn->query("SELECT subjects.subject_name, grades.grade 
                        FROM grades 
                        JOIN subjects ON grades.subject_id = subjects.id 
                        WHERE grades.student_id='$student_id'");

// Get assigned faculty
$faculty = $conn->query("SELECT faculty.name FROM faculty 
                         JOIN advisor ON faculty.id = advisor.faculty_id 
                         WHERE advisor.student_id='$student_id'")->fetch_assoc();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
<h2>Student Details</h2>

<div class="card p-3 mt-3">
<h4>Profile</h4>
Name: <?php echo $student['name']; ?><br>
Email: <?php echo $student['email']; ?><br>
Phone: <?php echo $student['phone']; ?><br>
Class: <?php echo $student['class']; ?><br>
Year: <?php echo $student['year']; ?><br>
GPA: <?php echo $student['gpa']; ?><br>
</div>

<div class="card p-3 mt-3">
<h4>Faculty</h4>
<?php echo $faculty['name']; ?>
</div>

<div class="card p-3 mt-3">
<h4>Grades</h4>
<?php
while($row = $grades->fetch_assoc()){
    echo $row['subject_name'] . " - " . $row['grade'] . "<br>";
}
?>
</div>
</div>