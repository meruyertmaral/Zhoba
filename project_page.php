<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "time_tracking";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Дерекқорға қосылу сәтсіз: " . $conn->connect_error);
}

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_name = $_POST['project_name'];
    $project_deadline = $_POST['project_deadline'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO projects (project_name, project_deadline, user_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $project_name, $project_deadline, $user_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Қате: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
