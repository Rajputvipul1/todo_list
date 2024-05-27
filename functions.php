<?php
$servername = "localhost";
$username = "vipul";
$password = "Vipul@123";
$dbname = "todo_list";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function addTask($task) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO tasks (task, completed) VALUES (?, 0)");
    $stmt->bind_param("s", $task);
    $stmt->execute();
    return $conn->insert_id;
}

function getTasks($completed = null) {
    global $conn;
    $query = "SELECT * FROM tasks";
    if ($completed !== null) {
        $query .= " WHERE completed = " . intval($completed);
    }
    $result = $conn->query($query);
    $tasks = [];
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }
    return $tasks;
}

function deleteTask($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

function completeTask($id) {
    global $conn;
    $stmt = $conn->prepare("UPDATE tasks SET completed = 1 WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

?>
