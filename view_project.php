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

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $project_id = $_GET['id'];

    $sql = "SELECT * FROM projects WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $project_id, $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $project = $result->fetch_assoc();
        echo "<h1>Жоба: " . htmlspecialchars($project['project_name']) . "</h1>";
        echo "<p>Дедлайн: " . htmlspecialchars($project['project_deadline']) . "</p>";
        echo "<form action='edit_project_process.php' method='POST'>
              <input type='hidden' name='id' value='" . $project_id . "'>
              <label>Жоба атауы: <input type='text' name='project_name' value='" . htmlspecialchars($project['project_name']) . "'></label>
              <label>Дедлайн: <input type='date' name='project_deadline' value='" . htmlspecialchars($project['project_deadline']) . "'></label>
              <button type='submit'>Өңдеу</button>
              </form>";
    } else {
        echo "Жоба табылмады.";
    }

    $stmt->close();
}

$conn->close();
?>
