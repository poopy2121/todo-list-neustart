<?php
$host = '127.0.0.1'; //immer bei xamp damit verbindung z database hergestellt werden
$db = 'todolist';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task']) && !empty($_POST['task'])) {
    $task = $_POST['task'];

    $stmt = $conn->prepare("INSERT INTO tasks (task) VALUES (?)");
    $stmt->bind_param("s", $task);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $task_id = $_POST['delete'];

    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $task_id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}

$sql = "SELECT * FROM tasks ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="checkboxAndli">';
        echo '<li>' . htmlspecialchars($row['task']) . '</li>';
        echo '<input type="checkbox" class="checkbox">';

        echo '<form method="POST" style="display:inline;">';
        echo '<input type="hidden" name="delete" value="' . $row['id'] . '">';
        echo '<button type="submit" class="remove">Remove</button>';
        echo '</form>';
        
        echo '</div>';
    }
} else {
    echo "<li>No tasks yet!</li>";
}

$conn->close();
?>