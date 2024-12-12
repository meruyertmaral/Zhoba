<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.html');
    exit();
}
include 'db.php';

$tasks = $conn->query("SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Тапсырмалар</title>
</head>
<body>
    <h1>Тапсырмалар</h1>
    <a href="dashboard.php">Басты бетке оралу</a>

    <ul>
        <?php while ($task = $tasks->fetch_assoc()): ?>
            <li><?= htmlspecialchars($task['name']) ?> (Дедлайн: <?= $task['deadline'] ?>)</li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
