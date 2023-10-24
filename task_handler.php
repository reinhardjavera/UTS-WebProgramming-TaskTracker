<?php
session_start();
include "db.php";

function Validation($id)
{
    include "db.php";
    $query = "SELECT user_id FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    if ($_SESSION['user_id'] != $row['user_id']) {
        return 0;
    } else {
        return 1;
    }
}

if (isset($_SESSION['user_id'])) {

    if (isset($_POST['add'])) {
        if (isset($_POST['task']) && isset($_POST['statusSelect'])) {
            $task = $_POST['task'];
            $detail = "";
            $status = $_POST['statusSelect'];
            if (isset($_POST['detail'])) {
                $detail = $_POST['detail'];
            }
            $q = "INSERT INTO tasks VALUES (NULL, ?, ?, ?, ?)";
            $stmt = $conn->prepare($q);
            $stmt->bind_param("sssi", $task, $detail, $status, $_SESSION['user_id']);
            $stmt->execute();
            header("location:index.php");
        }
    } elseif (isset($_POST['doneStatus'])) {
        if (isset($_POST['doneCheck'])) {
            $taskId = $_POST['taskId'];
            if (Validation($taskId) == 1) {
                $q = "UPDATE tasks SET status='done' WHERE id = ?";
                $stmt = $conn->prepare($q);
                $stmt->bind_param("i", $taskId);
                $stmt->execute();
            } else {
                echo ("no.");
            }
        } elseif (!isset($_POST['doneCheck'])) {
            $taskId = $_POST['taskId'];
            if (Validation($taskId) == 1) {
                $q = "UPDATE tasks SET status='in progress' WHERE id = ?";
                $stmt = $conn->prepare($q);
                $stmt->bind_param("i", $taskId);
                $stmt->execute();
            } else {
                echo ("no.");
            }
        }
        header("location:index.php");
    } elseif (isset($_POST['statusEdit'])) {
        $taskId = $_POST['taskId'];
        $status = $_POST['statusSelect'];
        if (Validation($taskId) == 1) {
            $q = "UPDATE tasks SET status=? WHERE id = ?";
            $stmt = $conn->prepare($q);
            $stmt->bind_param("si", $status, $taskId);
            $stmt->execute();
            header("location:index.php");
        } else {
            echo ("no.");
        }
    } elseif (isset($_POST['editTask'])) {
        $taskId = $_POST['taskId'];
        $task_name = $_POST['task'];
        $task_detail = $_POST['detail'];
        $status = $_POST['statusSelect'];
        if (Validation($taskId) == 1) {
            $q = "UPDATE tasks SET task_name=?, task_detail=?, status=? WHERE id = ?";
            $stmt = $conn->prepare($q);
            $stmt->bind_param("sssi", $task_name, $task_detail, $status, $taskId);
            $stmt->execute();
            header("location:index.php");
        } else {
            echo ("lol kamu hacker");
        }
    } elseif (isset($_POST['delete'])) {
        $taskId = $_POST['taskId'];
        if (Validation($taskId) == 1) {
            $q = "DELETE FROM tasks WHERE id = ?";
            $stmt = $conn->prepare($q);
            $stmt->bind_param("i", $taskId);
            $stmt->execute();
            header("location:index.php");
        } else {
            echo ("lol kamu hacker");
        }
    } else {
        header("location:index.php");
    }
}
