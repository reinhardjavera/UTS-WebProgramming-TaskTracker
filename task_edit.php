<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:login.php");
}
if (!isset($_POST['taskId'])) {
    header("location:index.php");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row pt-2">
            <div class="col text-center">
                <h2>Edit Task</h2>
            </div>
        </div>
        <form action="task_handler.php" method="post">
            <input type="hidden" name="taskId" value="<?= $_POST['taskId'] ?>">
            <div class="row pb-2">
                <div class="col">
                    <label for="exampleInputEmail1">Task</label>
                    <input type="text" class="form-control" name="task" placeholder="Enter Task" value="<?= $_POST['task_name'] ?>" required>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col">
                    <label for="exampleInputEmail1">Detail Task (Optional)</label>
                    <input type="text" class="form-control" name="detail" placeholder="Enter Detail Task" value="<?= $_POST['task_detail'] ?>">
                </div>
            </div>
            <div class="row pb-5">
                <div class="col">
                    <label for="exampleInputPassword1">Progress</label>
                    <select name="statusSelect" class="form-select" required>
                        <option value="not yet started" <?php if ($_POST['status'] == "not yet started") { ?> selected <?php } ?>>not yet started</option>
                        <option value="in progress" <?php if ($_POST['status'] == "in progress") { ?> selected <?php } ?>>in progress</option>
                        <option value="done" <?php if ($_POST['status'] == "done") { ?> selected <?php } ?>>done</option>
                    </select>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col">
                    <button type="submit" class="btn btn-primary" name="editTask" value="editTask">Submit</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>