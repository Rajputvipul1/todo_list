$(document).ready(function() {
    function renderTask(task, index) {
        let showCheckbox = task.completed == '0'; 
        return `<tr data-id="${task.id}">
            <td>${index + 1}</td>
            <td>${task.task}</td>
            <td>${task.completed == '1' ? 'Done' : ''}</td>
            <td>
                ${showCheckbox ? '<i class="bi bi-check-square text-success complete-task mr-2" style="cursor: pointer;"></i>' : ''}
                <i class="bi bi-x-circle text-danger delete-task" style="cursor: pointer;"></i>
            </td>
        </tr>`;
    }

    function fetchIncompleteTasks(showAll = false) {
        let action = showAll ? 'getAll' : 'getIncomplete';
        $.post('tasks.php', { action: action }, function(response) {
            let tasks = JSON.parse(response);
            $('#task-list').empty();
            tasks.forEach((task, index) => {
                $('#task-list').append(renderTask(task, index));
            });
            if (!showAll) {
                attachTaskEventHandlers(); 
            }
        });
    }

    $('#task-form').submit(function(e) {
        e.preventDefault();
        let task = $('#task-input').val().trim();
        if (task) {
            $.post('tasks.php', { action: 'add', task: task }, function(response) {
                response = JSON.parse(response);
                if (response.error) {
                    alert(response.error);
                } else {
                    $('#task-list').append(renderTask(response, $('#task-list tr').length));
                    attachTaskEventHandlers(); 
                    $('#task-input').val('');
                }
            });
        }
    });

    function attachTaskEventHandlers() {
        // Delete
        $('#task-list').off('click', '.delete-task').on('click', '.delete-task', function() {
            if (confirm('Are you sure to delete this task?')) {
                let row = $(this).closest('tr');
                let id = row.data('id');
                $.post('tasks.php', { action: 'delete', id: id }, function(response) {
                    response = JSON.parse(response);
                    if (response.success) {
                        row.remove();
                    }
                });
            }
        });

        // Complete
        $('#task-list').off('click', '.complete-task').on('click', '.complete-task', function() {
            let row = $(this).closest('tr');
            let id = row.data('id');
            
            // default list 
            if ($('#show-all').data('default-list') === 'true') {
                $.post('tasks.php', { action: 'complete', id: id }, function(response) {
                    response = JSON.parse(response);
                    if (response.success) {
                        row.remove(); 
                    }
                });
            } else {
                $.post('tasks.php', { action: 'complete', id: id }, function(response) {
                    response = JSON.parse(response);
                    if (response.success) {
                        row.find('td:nth-child(3)').text('Done'); 
                        row.find('.complete-task').remove(); 
                    }
                });
            }
        });
    }

    $('#show-all').click(function() {
        fetchIncompleteTasks(true); 
        $('#show-all').data('default-list', 'false'); // not the default list
    });

    //incomplete tasks (default list)
    fetchIncompleteTasks();
    $('#show-all').data('default-list', 'true'); // default list
});
