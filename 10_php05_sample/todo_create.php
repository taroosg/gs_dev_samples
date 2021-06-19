<?php
session_start();
include("functions.php");
check_session_id();

if (
  !isset($_POST['todo']) || $_POST['todo'] == '' ||
  !isset($_POST['deadline']) || $_POST['deadline'] == ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

$todo = $_POST['todo'];
$deadline = $_POST['deadline'];

$pdo = connect_to_db();

$sql = 'INSERT INTO todo_table(id, todo, deadline, created_at, updated_at) VALUES(NULL, :todo, :deadline, sysdate(), sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:todo_input.php");
  exit();
}
