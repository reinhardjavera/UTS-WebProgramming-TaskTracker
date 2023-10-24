<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:login.php");
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
                <h2>Add New Task</h2>
            </div>
        </div>
        <form action="task_handler.php" method="post">
            <div class="row pb-2">
                <div class="col">
                    <label for="exampleInputEmail1">Task</label>
                    <input type="text" class="form-control" name="task" placeholder="Enter Task" required>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col">
                    <label for="exampleInputEmail1">Detail Task (Optional)</label>
                    <input type="text" class="form-control" name="detail" placeholder="Enter Detail Task">
                </div>
            </div>
            <div class="row pb-5">
                <div class="col">
                    <label for="exampleInputPassword1">Progress</label>
                    <select name="statusSelect" class="form-select" required>
                        <option value="not yet started" selected>not yet started</option>
                        <option value="in progress">in progress</option>
                        <option value="done">done</option>
                    </select>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col">
                    <button type="submit" class="btn btn-primary" name="add" value="add">Submit</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>