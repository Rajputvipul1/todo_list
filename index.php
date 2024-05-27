<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">To-Do List</h1>
        <form id="task-form" class="form-inline my-4">
            <input type="text" id="task-input" class="form-control mr-2" placeholder="New Task">
            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>
        <button id="show-all" class="btn btn-secondary mb-3">Show All Tasks</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="task-list">
            </tbody>
        </table>
    </div>

    <script src="assets/tasks.js"></script>
</body>
</html>
