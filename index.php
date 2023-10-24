<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light p-2">
        <a class="navbar-brand" href="#"><b>To Do List</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav ms-auto">
                <div id="user-info">
                    <?php
                    if (isset($_SESSION['user_id'])) {
                    ?>
                        Hello, <?= $_SESSION['username'] ?>
                        <a href="logout.php" class="btn btn-secondary">Logout</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>

    <script>
        function autoSubmit() {
            var formObj = document.forms['taskForm']
        }
    </script>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h2>Tasks</h2>
            </div>
        </div>
        <div class="row">
            <div class="col pt-3 pb-3 text-center">
                <a href="add_task.php" class="btn btn-primary">Add new task</a>
            </div>
        </div>
        <div class="row">
            <div id="tasks">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Task</th>
                            <th scope="col">Detail</th>
                            <th scope="col">Done</th>
                            <th scope="col">Progress</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('db.php'); // File koneksi database

                        $sql = "SELECT * FROM tasks WHERE user_id = ?";
                        $stmt = $conn->prepare($sql);
                        $user_id = $_SESSION['user_id'];
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $i = 0;
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                        ?>

                            <tr>

                                <th><?= $i ?></th>
                                <td>
                                    <?php
                                    if ($row['status'] == "done") {
                                    ?>
                                        <p><strike><?= $row['task_name'] ?></strike></p>
                                    <?php
                                    } else { ?>
                                        <p><?= $row['task_name'] ?></p>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td><?= $row['task_detail'] ?></td>
                                <td>
                                    <form action="task_handler.php" id="doneForm<?= $row['id'] ?>" method="post">
                                        <input type="checkbox" class="form-check-input" name="doneCheck" id="done" <?php if ($row['status'] == "done") { ?> checked <?php } ?> onchange="submitDone(<?= $row['id'] ?>)"> Done
                                        <input type="hidden" name="doneStatus">
                                        <input type="hidden" name="taskId" value="<?= $row['id'] ?>">
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="task_handler.php" id='theForm<?= $row['id'] ?>'>
                                        <input type="hidden" name="taskId" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="statusEdit">
                                        <select name="statusSelect" class="form-select" onchange="autoSubmit(<?= $row['id'] ?>)">
                                            <option value="not yet started" <?php if ($row['status'] == "not yet started") { ?> selected <?php } ?>>not yet started</option>
                                            <option value="in progress" <?php if ($row['status'] == "in progress") { ?> selected <?php } ?>>in progress</option>
                                            <option hidden value="done" <?php if ($row['status'] == "done") { ?> selected <?php } ?>>done</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <form action="task_edit.php" method="post">
                                        <input type="hidden" name="taskId" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="task_name" value="<?= $row['task_name'] ?>">
                                        <input type="hidden" name="task_detail" value="<?= $row['task_detail'] ?>">
                                        <input type="hidden" name="status" value="<?= $row['status'] ?>">
                                        <button type="submit" href="task_edit.php" class="btn btn-success">Edit</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="task_handler.php" id='theForm<?= $row['id'] ?>'>
                                        <input type="hidden" name="taskId" value="<?= $row['id'] ?>">
                                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function submitDone(id) {
            document.getElementById('doneForm' + id).submit();
        }

        function autoSubmit(id) {
            document.getElementById('theForm' + id).submit();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>