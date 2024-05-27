<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add':
            $task = $_POST['task'] ?? '';
            if (!empty($task)) {
                $tasks = getTasks();
                foreach ($tasks as $t) {
                    if ($t['task'] === $task) {
                        echo json_encode(['error' => 'Duplicate task']);
                        exit;
                    }
                }
                $id = addTask($task);
                echo json_encode(['id' => $id, 'task' => $task, 'completed' => 0]);
            } else {
                echo json_encode(['error' => 'Task cannot be empty']);
            }
            break;

        case 'delete':
            $id = $_POST['id'] ?? 0;
            if ($id) {
                deleteTask($id);
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['error' => 'Invalid task ID']);
            }
            break;

        case 'complete':
            $id = $_POST['id'] ?? 0;
            if ($id) {
                completeTask($id);
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['error' => 'Invalid task ID']);
            }
            break;

        case 'getAll':
            $tasks = getTasks();
            echo json_encode($tasks);
            break;

        case 'getIncomplete':
            $tasks = getTasks(0);
            echo json_encode($tasks);
            break;

        default:
            echo json_encode(['error' => 'Invalid action']);
            break;
    }
}

$conn->close();
?>
