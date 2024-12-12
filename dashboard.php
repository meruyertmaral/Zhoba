<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.html');
    exit();
}
include 'db.php';
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Жобалар тақтасы</title>
    <script src="timer.js" defer></script>
</head>
<body>
    <h1>Сәлем, <?= htmlspecialchars($_SESSION['user']['name']) ?>!</h1>
    <p>Мұнда сіз өз уақытыңызды бақылай аласыз:</p>

    <div>
        <button onclick="startTimer()">Таймерді бастау</button>
        <button onclick="stopTimer()">Таймерді тоқтату</button>
        <p id="timerDisplay">00:00:00</p>
    </div>

    <a href="tasks.php"><button>Тапсырмалар</button></a>
    <a href="logout.php">Шығу</a>
</body>
</html>
