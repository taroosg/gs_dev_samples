<?php
session_start();
include("functions.php");
check_session_id();

$id = $_GET["id"];

$pdo = connect_to_db();

$sql = "DELETE FROM todo_table WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:todo_read.php");
  exit();
}
