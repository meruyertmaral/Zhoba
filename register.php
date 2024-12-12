<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "time_tracking";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Дерекқорға қосылу сәтсіз: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        header("Location: login.html");
        exit();
    } else {
        echo "Қате: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
