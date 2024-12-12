<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "time_tracking";

// Дерекқорға қосылу
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Дерекқорға қосылу сәтсіз: " . $conn->connect_error);
}

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Дерекқордан пайдаланушыны іздеу
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('MySQL prepare сәтсіз аяқталды: ' . $conn->error);  // Егер prepare сәтсіз болса, қате шығарылады
}


    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Пайдаланушы табылса
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Құпия сөзді тексеру
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Қате: Құпия сөз дұрыс емес.";
        }
    } else {
        echo "Қате: Пайдаланушы табылмады.";
    }

    $stmt->close();
}

$conn->close();
?>

